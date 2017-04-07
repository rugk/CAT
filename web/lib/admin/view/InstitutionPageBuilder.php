<?php
namespace web\lib\admin\view;
use web\lib\admin\PageDecoration;
use web\lib\common\InputValidation;

/**
 * Class that can be used to layout any administrator page that manages things for particular IdP.
 * 
 * @author Zilvinas Vaira
 * @package web\lib\admin\view
 */
class InstitutionPageBuilder implements PageBuilder{
    
   /**
    * Particular IdP instance. If set to null means that page is entered by a mistake.
    * 
    * @var \core\IdP
    */
    protected $institution = null;
    
    /**
     * Complete page title text.
     * 
     * @var string
     */
    private $pageTitle = "Unknown Page";
    /**
     * Complete header title text.
     * 
     * @var string
     */
    private $headerTitle = "Unknown Page";
    
    /**
     * Page type identifier.
     * 
     * @todo Page type behaviour could be handled by particular page object instead.
     * @see PageBuilder for constants with type values.
     * @var string
     */
    private $pageType = "";
    
    /**
     * Provides a set of global page elements such as prelude, header and footer.
     * 
     * @var PageDecoration
     */
    private $decoration;
    
    /**
     * Provides global validation services.
     * 
     * @var InputValidation
     */
    private $validation;
    
    /**
     * 
     * @var PageElementInterface[][]
     */
    private $contentElements = array();
    
    /**
     * 
     * @var integer
     */
    private $contentIndex = 0;
    
    /**
     * Initiates basic building blocks for a page and validates Idp.
     * 
     * @param Page $page Common title slug that identifies main feature of the page.
     * @param string $pageType Page type identifier.
     */
    public function __construct($page, $pageType){
        $this->decoration = new PageDecoration();
        $this->validation = new InputValidation();
        if(isset($_GET['inst_id'])){
            try {
                $this->validateInstitution();
            } catch (\Exception $e) {
                $this->headerTitle = $e->getMessage();
            }
            
            if($this->isReady()){
                $this->pageType = $pageType;
                $this->pageTitle = sprintf(_("%s: %s '%s'"), CONFIG['APPEARANCE']['productname'], $page->getTitle(), $this->institution->name);
                $this->headerTitle = sprintf(_("%s information for '%s'"), $page->getTitle(), $this->institution->name);
            }
        }
    }
    
    /**
     * 
     */
    protected function validateInstitution(){
        $this->institution = $this->validation->IdP($_GET['inst_id'], $_SESSION['user']);
    }
    
    /**
     * @return boolean
     */
    public function isReady(){
        return isset($this->institution);
    }
    
    /**
     * 
     * @return IdP
     */
    public function getInstitution(){
        return $this->institution;
    }
    
    /**
     * 
     * @return \core\ProfileSilverbullet|mixed
     */
    public function getProfile(){
        $profile = null;
        if($this->isReady()){
            $profiles = $this->institution->listProfiles();
            if (count($profiles) == 1) {
                if ($profiles[0] instanceof \core\ProfileSilverbullet) {
                    $profile = $profiles[0];
                }
            }
        }
        return $profile;
    }
    
    /**
     * 
     * @return \core\IdP
     */
    public function getRealmName(){
        $realmName = 'unknown';
        $profile = $this->getProfile();
        if(!empty($profile)){
            $realmName = $profile->realm;
        }
        return $realmName;
    }
    
    public function addContentElement($element){
        $this->contentElements [$this->contentIndex] [] = $element;
    }
    
    public function addContentSeparator(){
        $this->contentIndex++; 
    }
    
    /**
     * Prints page beginning elements. 
     * 
     */
    public function createPagePrelude(){
        echo $this->decoration->defaultPagePrelude($this->pageTitle);
    }
    
    /**
     * {@inheritDoc}
     * @see \web\lib\admin\view\PageBuilder::renderPageHeader()
     */
    public function renderPageHeader(){
        $langHandler = new \core\Language();
        echo $this->decoration->productheader($this->pageType, $langHandler->getLang());
        ?>
        <h1>
            <?php echo $this->headerTitle; ?>
        </h1>
        <?php
    }
    
    /**
     * {@inheritDoc}
     * @see \web\lib\admin\view\PageBuilder::renderPageFooter()
     */
    public function renderPageFooter(){
        echo $this->decoration->footer();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \web\lib\admin\view\PageBuilder::renderContent()
     */
    public function renderPageContent(){
        foreach ($this->contentElements as $inlineElements) {
            foreach ($inlineElements as $element) {
                $element->render();
            }
        }
    }

}