# CakePHP Admin Plugin

A CakePHP Plugin for sexier admin scaffolding using Twitter Bootstrap.

## Installation

1. Copy the plugin to ``app/Plugin/Admin``
1. Enable the plugin in ``app/Config/bootstrap.php``

    ```CakePlugin::loadAll(array('Admin' => array('bootstrap' => true)));```

## Usage

1. Go to ``http://example.com/admin`` where ``example.com`` is the URL of your website
1. The main navigation is built "automagically" from the models in ``app/Model``
1. Start administering