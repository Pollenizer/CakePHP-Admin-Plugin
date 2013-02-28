# CakePHP Admin Plugin

A CakePHP Plugin for sexier admin scaffolding using Twitter Bootstrap.

## Installation

1. Copy the plugin to ``app/Plugin/Admin``
1. Enable the plugin in ``app/Config/bootstrap.php``

<pre>CakePlugin::loadAll(array(
    'Admin' => array(
        'bootstrap' => true
    )
));</pre>

## Usage

1. Go to ``http://example.com/admin`` where ``example.com`` is the URL of your website
1. The main navigation is built "automagically" from the models in ``app/Model``
1. Start administering

## Authorization

In order to control access to Admin actions, the plugin supports a ``adminIsAuthorized()`` callback function. Use of the callback is not required and by default, access to all actions is unrestricted.

To use the ``adminIsAuthorized()`` callback function:

1. Create the ``adminIsAuthorized()`` function in ``app/Config/bootstrap.php``
1. return boolean ``true`` to allow access or boolean ``false`` to deny access

<pre>function adminIsAuthorized()
{
    if (the user is authorized) {
        return true;
    }
    return false;
}</pre>
