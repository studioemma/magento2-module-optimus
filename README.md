## Synopsis

This modules contains several enhancements to Magento for our Mase 2 Optimus theme


## Content examples

There are currently 4 content example pages included in this module. This is to show the client how html is displayed in their site, what layout options are possible, what they can do with images and so forth.

All html is valid & already provided with the necessary RWD styling.

- `{base_url}/content/basic` : shows all standard html tags and how they look on their site
- `{base_url}/content/layout`: shows all possible layouts (grids) with text & images
- `{base_url}/content/interaction` : shows content with FAQ style accordion, show more/less text etc.
- `{base_url}/content/images` : shows all variaties of images they can use on their site. Page wide, floating in text, left & right columns.
- `{base_url}/content/specific` : shows all specific content blocks a client can use on their site. They are not general blocks, specific to the customer's needs

When applicable, an option is provided to copy/paste the html code needed to obtain these examples. These need to be copied over to the wysiwyg editor in Magento and afterwards, the client can change all texts & images.


## Improved mobile menu - NOT YET AVAILABLE

For larger catalog trees, the default menu isn't so user friendly, so we created our own mobile menu.


## Installation

This module is intended to be installed using composer.  
After the code is marshalled by composer, enable the module by adding it the list of enabled modules in [the config](app/etc/config.php) or, if that file does not exist, installing Magento.
After including this component and enabling it, you can verify it is installed by going the backend at:

STORES -> Configuration -> ADVANCED/Advanced ->  Disable Modules Output

Once there check that the module name shows up in the list to confirm that it was installed correctly.

## Tests

Unit tests are found in the [Test/Unit](Test/Unit) directory.

## Contributors

Studio Emma

## License

[Open Source License](LICENSE.txt)
