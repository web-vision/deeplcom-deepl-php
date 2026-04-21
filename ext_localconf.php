<?php

use TYPO3\CMS\Core\Core\Environment;

defined('TYPO3') or die();

// Compatibility layer to provide autoloading for bundled libraries in classic mode instances prior
// to TYPO3 v14.3, which will use `extra.typo3/cms.Package.providesPackage` from the `composer.json`
// to add autoloading early in TYPO3 bootstrap.
// Having the contrib library included in the git repo allows checking out the extension from git
// in classic mode installations to `typo3conf/ext` and still have the required library provided.
// @todo typo3/cms:>=14.3 Remove this compatibility layer providing contrib library autoloading.
if (!class_exists(\DeepL\DeepLClient::class)) {
    require Environment::getExtensionsPath() . '/deeplcom_deeplphp/contrib/Libraries/autoload.php';
}
