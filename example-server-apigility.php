<?php
namespace FirstAPI\V1\Rpc\FirstRPCService;

use Zend\Mvc\Controller\AbstractActionController;

class FirstRPCServiceController extends AbstractActionController
{
    public function firstRPCServiceAction()
    {
        $aPostContent = json_decode($this->getRequest()->getContent(), true);
        $firstvalue = (int)$aPostContent['firstvalue'];
        $secondvalue = (int)$aPostContent['secondvalue'];
        
        return array(
            'result' => $firstvalue+$secondvalue
                );
    }
}

