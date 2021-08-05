<?php
class AdvancedsearchaSearchModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:advancedsearch/views/templates/front/display.tpl');
    }

    public function collectionSearch($parameters)
    {
        
    }

    public function postProcess() {
        //var_dump($_POST);
        // AIzaSyBWNZPFPLbEnxXa95adqBU5cEBnA_vd75g
        if(isset($_POST["retrieve"]) && $_POST["retrieve"] == "collection"){
            $this->collectionSearch($_POST);
        }


    }
}
