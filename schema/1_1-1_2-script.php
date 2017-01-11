<?php

/*
 * ******************************************************************************
 * Copyright 2011-2017 DANTE Ltd. and GÉANT on behalf of the GN3, GN3+, GN4-1 
 * and GN4-2 consortia
 *
 * License: see the web/copyright.php file in the file structure
 * ******************************************************************************
 */

/*
 * Run this script after the DB schema update is complete. It converts multilang
 * attributes from "serialize()" to proper DB columns and moves IdP-wide EAP
 * options to profile level.
 */

// treating serialize()

require_once("../config/_config.php");

CONST TREATMENT_TABLES = ['federation_option', 'institution_option', 'profile_option', 'user_options'];
CONST TREATMENT_COLUMNS = ['row', 'row', 'row', 'id'];

$dbInstance = \core\DBConnection::handle('INST');

$treatment_options = [];

$optionsInNeed = $dbInstance->exec("SELECT name FROM profile_option_dict WHERE flag = 'ML'");
while ($optionsResultRow = mysqli_fetch_object($optionsInNeed)) {
    $treatment_options[] = $optionsResultRow->name;
}
foreach (TREATMENT_TABLES as $tableIndex => $tableName) {
    foreach ($treatment_options as $optionName) {
        $affectedPayloads = $dbInstance->exec("SELECT " . TREATMENT_COLUMNS[$tableIndex] . " AS row, option_lang, option_value FROM $tableName WHERE option_name = '$optionName'");
        if ($affectedPayloads === FALSE) {
            echo "[FAIL] Unknown error querying update status for option " . $optionName . " in table $tableName. Did you run the 'ALTER TABLE' statements?\n";
            continue;
        }
        while ($oneAffectedPayload = mysqli_fetch_object($affectedPayloads)) {
            if ($oneAffectedPayload->option_lang !== NULL) {
                echo "[SKIP] The option in row " . $oneAffectedPayload->row . " of table $tableName appears to be converted already. Not touching it.\n";
                continue;
            }
            $decoded = unserialize($oneAffectedPayload->option_value);
            if ($decoded === FALSE || !isset($decoded["lang"]) || !isset($decoded['content'])) {
                echo "[WARN] Please check row " . $oneAffectedPayload->row . " of table $tableName - this entry did not successfully unserialize() even though it is a multi-lang attribute!\n";
                continue;
            }
            // pry apart lang and content into their own columns
            $rewrittenPayload = $dbInstance->exec("UPDATE $tableName SET option_lang = ?, option_value = ? WHERE " . TREATMENT_COLUMNS[$tableIndex] . " = " . $oneAffectedPayload->row, "ss", $decoded["lang"], $decoded["content"]);
            if ($rewrittenPayload !== FALSE) {
                echo "[ OK ] " . $oneAffectedPayload->option_value . " ---> " . $decoded["lang"] . " # " . $decoded["content"] . "\n";
                continue;
            }
            echo "[FAIL] Unknown error executing the payload update for row " . $oneAffectedPayload->row . " of table $tableName. Did you run the 'ALTER TABLE' statements?\n";
        }
    }
}

// moving EAP options from IdP to Profile(s)

$eap_options = ['eap:ca_file', 'eap:server_name'];
$conditionString = "WHERE ";
$typeString = "";
foreach ($eap_options as $index => $name) {
    $conditionString .= ($index == 0 ? "" : "OR ") . "option_name = ? ";
    $typeString .= "s";
}
$idpWideOptionsQuery = $dbInstance->exec("SELECT institution_id, option_name, option_lang, option_value FROM institution_option $conditionString", $typeString, $eap_options[0], $eap_options[1]);

$profiles = []; // index is inst id, value is an array of profile objects and the IdP object. Populated as we iterate through the data set

while ($oneAttrib = mysqli_fetch_object($idpWideOptionsQuery)) {
    if (!isset($profiles[$oneAttrib->institution_id])) {
        $idp = new \core\IdP($oneAttrib->institution_id);
        $profiles[$oneAttrib->institution_id] = ['IdP' => $idp, 'Profiles' => $idp->listProfiles()];
        echo "Debug: IdP " . $idp->identifier . " has profiles ";
        foreach ($profiles[$oneAttrib->institution_id]['Profiles'] as $oneProfileObject) {
            echo $oneProfileObject->identifier . " ";
        }
        echo "\n";
    }
    // add the attribute to all RADIUS profiles
    foreach ($profiles[$oneAttrib->institution_id]['Profiles'] as $oneProfileObject) {
        if ($oneProfileObject instanceof \core\ProfileRADIUS) {
            $hasOnProfileLevel = FALSE;
            $relevantAttributes = $oneProfileObject->getAttributes($oneAttrib->option_name);
            foreach ($relevantAttributes as $relevantAttribute) {
                if ($relevantAttribute['level'] == 'Profile') {
                    $hasOnProfileLevel = TRUE;
                    echo "[SKIP] EAP option " . $oneAttrib->option_name . " for IdP " . $profiles[$oneAttrib->institution_id]['IdP']->name . " (ID " . $profiles[$oneAttrib->institution_id]['IdP']->identifier . "), profile " . $oneProfileObject->name . " (ID " . $oneProfileObject->identifier . ") because Profile has EAP override.\n";
                }
            }
            if ($hasOnProfileLevel === FALSE) { // only add if profile didn't previously override IdP wide anyway!
                $oneProfileObject->addAttribute($oneAttrib->option_name, $oneAttrib->option_lang, $oneAttrib->option_value);
                echo "[OK  ] Added profile EAP option " . $oneAttrib->option_name . " for IdP " . $profiles[$oneAttrib->institution_id]['IdP']->name . " (ID " . $profiles[$oneAttrib->institution_id]['IdP']->identifier . "), profile " . $oneProfileObject->name . " (ID " . $oneProfileObject->identifier . ").\n";
            }
        }
    }
    // delete it from the IdP level
    $deletionQuery = $dbInstance->exec("DELETE FROM institution_option WHERE institution_id = ? AND option_name = ? and option_lang = ? and option_value = ?", "isss", $oneAttrib->institution_id, $oneAttrib->option_name, $oneAttrib->option_lang, $oneAttrib->option_value);
    echo "[OK  ] Deleted IdP-wide EAP option " . $oneAttrib->option_name . " for IdP " . $profiles[$oneAttrib->institution_id]['IdP']->name . " (ID " . $profiles[$oneAttrib->institution_id]['IdP']->identifier . ").\n";
}