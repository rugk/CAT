��    5      �  G   l      �  �   �  �   y  �   3  \   �  �   7  	        )     <  F   [     �  5   �  ,   �  O   $	  U   t	  P   �	    
  �   +  #  �  +    J   A  �   �  3   L  [   �  v   �  �   S  -     �   0  =     7   V  E   �  7   �  ,     ]   9  1   �  "   �     �        
   %  
   0     ;     O  !   g     �     �  *   �     �     �     �     �     �       =   "  �  `    �  �     �   �  l   �  �     
   �     �  (     J   @     �  <   �  '   �  R     Z   W  O   �      �     O  �  C  �  Q   8!  �   �!  >   O"  h   �"  �   �"  �   �#  >   ;$    z$  ]   ~%  K   �%  P   (&  G   y&  7   �&  R   �&  +   L'  %   x'     �'  (   �'     �'     �'      (     (  !   9(     [(     r(  0   y(     �(     �(     �(  	   �(     �(     )  L   )     #              -                   2         (      .                       0           $           /      4      5   3   ,          '                 !             
           +                     *         &   	   1         )   %   "                 At least one certificate did not contain any BasicConstraints extension; which makes it unclear if it's a CA certificate or end-entity certificate. At least Mac OS X 10.8 (Mountain Lion) will not validate this certificate for EAP purposes! At least one certificate in the chain had a public key of less than 1024 bits. Many recent operating systems consider this unacceptable and will fail to validate the server certificate. At least one certificate in the chain is signed with the MD5 signature algorithm. Many Operating Systems, including Apple iOS, will fail to validate this certificate. At least one certificate is outside its validity period (not yet valid, or already expired)! At least one intermediate certificate in your CAT profile is outside its validity period (not yet valid, or already expired), but this certificate was not used for server validation. Consider removing it from your %s configuration. Completed Connection refused EAP method negotiation failed! NAPTR records were found, but all of them refer to unrelated services. Nicolaus Copernicus University Not enough data provided to perform an authentication The CRL of a certificate could not be found. The EAP server name does not match any of the configured names in your profile! The RADIUS server immediately rejected the authentication request in its first reply. The RADIUS server rejected the authentication request after an EAP conversation. The certificate chain as received in EAP was not sufficient to verify the certificate to the root CA in your profile. It was verified using the intermediate CAs in your profile though. You should consider sending the required intermediate CAs inside the EAP conversation. The certificate chain includes the root CA certificate. This does not serve any useful purpose but inflates the packet exchange, possibly leading to more round-trips and thus slower authentication. The certificate contained a CN or subjectAltName:DNS which contains a wildcard ('*'). This can be problematic on some supplicants. If the certificate also contains names which are wildcardless, and you only use those for your supplicant configuration, then you can safely ignore this notice. The certificate contained a CN or subjectAltName:DNS which does not parse as a hostname. This can be problematic on some supplicants. If the certificate also contains names which are a proper hostname, and you only use those for your supplicant configuration, then you can safely ignore this notice. The certificate password you provided does not match the certificate file. The configured EAP server name matches either the CN or a subjectAltName:DNS of the incoming certificate; best current practice is that the certificate should contain the name in BOTH places. The server accepted the INVALID client certificate. The server certificate could not be verified to the root CA you configured in your profile! The server certificate did not include a CRL Distribution Point, creating compatibility problems with Windows Phone 8. The server certificate does not have the extension 'extendedKeyUsage: TLS Web Server Authentication'. Most Microsoft Operating Systems will fail to validate this certificate. The server certificate was revoked by the CA! The server certificate's 'CRL Distribution Point' extension does not point to an HTTP/HTTPS URL. Some Operating Systems may fail to validate this certificate. Checking server certificate validity against a CRL will not be possible. The server presented a certificate from an unknown authority. The server rejected the client certificate as expected. The server rejected the client certificate, even though it was valid. There is more than one server certificate in the chain. There is no server certificate in the chain. There was a bidirectional communication with the RADIUS server, but it ended halfway through. There was no reply at all from the RADIUS server. There were errors during the test. This check was skipped. This realm has no NAPTR records. accredited bad policy certificate expired certificate was revoked certificate with wrong policy OID correct certificate eduPKI eduroam-accredited CA (now only for tests) expired certificate fail non-accredited pass revoked certificate unknown authority unknown authority or no certificate policy or another problem Project-Id-Version: eduroam CAT
Report-Msgid-Bugs-To: 
PO-Revision-Date: 2015-04-07 14:08+0000
Last-Translator: Janos Mohacsi <mohacsi@niif.hu>
Language-Team: Hungarian (http://www.transifex.com/projects/p/cat/language/hu/)
Language: hu
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=(n != 1);
                                          Legalább 1 tanusítvány nem tartalmaz semmilyen BasicConstraints kiegeszítést. Ez alapján nem világos, hogy a tanusítvány CA tanusítvány, vagy végponti tanusítvány. Legalább a Mac OS X 10.8 (Mountain Lion) nem fogadja el ezt a tanusítványt EAP célokra.  A tanusítványlánc legalább 1 tanusítványának publikus kulcsa kisebb mint 1024 bit. Sok újabb operációs rendszer ezt nem tartja elfogadhatónak és a szerver tanusítványt nem fogadja el.  Legalább 1 szerver tanusítvány a tanusítványláncban MD5-el van aláírva. Sok operációs rendszer, sok operációs rendszer (pl. Apple iOS, Windows 8.x) nem fogja elfogadni a tanusítványláncot.  Legalább 1 tanusítvány az érvényességi idején kivüli (még nem érvenyes, vagy már nem érvényes). Legalább 1 köztes tanusítvány az érvényességi idején kivüli (még nem érvenyes, vagy már nem érvényes), de ez a tanusítvány nem használt a szerver azonosításához. Érdemes volna kivenni a %s konfigurációból. Befejezett Kapcsolódás elutasítva EAP metódus megbeszélése meghiúsult. NAPTR rekord létezik, de mindegyike nem releváns szolgáltatásra mutat. Kopernikusz Egyetem Nem adtál meg elég adatot az azonosítás elvégzéséhez. A tanusítvány CRL-je nem található. Az EAP szerver neve nem illeszkedik a profile-ban semmilyen konfigurált névvel.  A RADIUS szerver rögtön visszautasította az azonosítási kérést az első válaszban. RADIUS visszautasította az azonosítási kérést az EAP csomagváltás után. Az EAP során érkezett  tanusítvány lánc nem ellenőrizhető azzal a root CA-val, amely a profile-hoz konfigurálva lett. A profile köztes CA-jával azonban ellenőrizheő volt. Javasolt a szükséges köztes CA-k küldése az EAP üzenetváltásban.    A tanusítvány lány tartalmazza a gyökér CA tanusítványt. Ez szükségtelen, növelheti a csomagváltások számát ezáltal lassítva az azonosítást. A tanusítvány CN vagy subjectAltName:DNS mezeje wildcard ("*")-or tartalmaz . Ez néhány supplicant számára problémát jelent. Ha tanusítvány tartalmazza olyan nevet, amely nem tartalmaz wildcard-ot és ez a tanusítvány csak a supplicant konfigurációhoz van használva, akkor ezt a megjegyzést figyelmen kívül hagyhatod. A tanusítvány CN vagy subjectAltName:DNS nem tartalmaz szervernevet. Ez néhány supplicant számára problémát jelent. Ha tanusítvány tartalmazza a nevet, amely egy megfelelő szervernév és ez a tanusítvány csak a supplicant konfigurációhoz van használva, akkor ezt a megjegyzést figyelmen kívül hagyhatod. A megadott tanusítvány jelszó nem tanusítvány fájlban lévőhöz tartozik.  A konfigurált EAP szerver neve nem illeszkedik a beérkező tanusítvány CN vagy subjectAltName:DNS mezejével . A legjobb megoldás az, ha tanusítvány MINDKÉT helyen tartalmazza ezt a nevet. A szerver egy érvénytelen kliens tanusítványt fogadott el. A szerver tanusítvány nem ellenőrizhető azzal a root CA-val, amely a profile-hoz konfigurálva lett. A szerver tanusítvány nem tartalmaz CRL Distribution Point attributumot. Ez kompatbilitási problémát jelent a Windows Phone 8 esetén. A szerver tanusítvány nem tartmazza 'extendedKeyUsage: TLS Web Server Authentication' kiegészítést. A legtőbb Microsoft operációs rendszer nem fogadja el ezt a tanusítványt. A szerver tanusítványt visszavonta a tanusítványhatóság! A szerver tanusítvány 'CRL Distribution Point' kiegészítése nem egy HTTP/HTTPS URL. Néhány operációs rendszer lehetséges, hogy nem fogja tudni ellenőrizni a tanusítványt. A szerver tanusítvány ellenőrzése a CRL alapján nem lesz lehetséges.  A szerver egy ismeretlen tanusítvány hatóság által aláírt tanusítványt mutatott be.  A szerver visszautasította kliens tanusítványt, ahogy az várható volt. A szerver visszautasított egy kliens tanusítványt, habár az érvényes volt. Több mint 1 szervertanusítvány található a tanusítvány láncban. Nincsen szerver tanusítvány a tanusítvány láncban. Két irányú kommunikáció elindult a RADIUS szerverrel, de nem fejeződött be. Nem érkezett válasz a RADIUS szervertől. Hiba történt az ellenőrzés során Ezt az ellenőrzést kihagytuk Ennel a realm-nek nincsen NAPTR rekordja minősített rossz policy a tanúsítvány lejárt a tanúsítványt visszavonták rossz policy OID-ű tanusítvány korrekt tanúsítvány eduPKI eduroam-minősített CA (most csak teszt célű) lejárt tanúsítvány nem sikerült nem minősített sikerült visszavont tanúsítvány ismeretlen hatóság ismeretlen hatóság vagy nincsen tanusítvány policy vagy egyéb probléma 