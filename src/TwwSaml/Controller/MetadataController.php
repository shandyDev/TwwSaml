<?php

namespace TwwSaml\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MetadataController extends AbstractActionController
{

    public function indexAction()
    {
        try {
            $settings = $this->auth->getSettings();
            $metadata = $settings->getSPMetadata();
            $errors = $settings->validateMetadata($metadata);
            if (empty($errors)) {
                header('Content-Type: text/xml');
                echo $metadata;
            } else {
                throw new \OneLogin_Saml2_Error(
                    'Invalid SP metadata: '.implode(', ', $errors),
                    \OneLogin_Saml2_Error::METADATA_SP_INVALID
                );
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
