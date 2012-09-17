# ChromePhp

Thanks to https://github.com/ccampbell/chromephp for 99,9999% of the code.

### Quick Start

1. Download the Chrome Extension at http://www.chromephp.com/

1. Install the bundle

        php artisan bundle:install chromephp

1. Add it to your application's `bundles.php`

        return array(
            'chromephp' => array(
            	'auto' => true,
            ),
        );

1. Start Logging

        ChromePhp::log('hello world');
        ChromePhp::log($_SERVER);

        // using labels
        foreach ($_SERVER as $key => $value) {
            ChromePhp::log($key, $value);
        }

        // warnings and errors
        ChromePhp::warn('this is a warning');
        ChromePhp::error('this is an error');