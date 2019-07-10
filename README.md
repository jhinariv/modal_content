# Modal Content
_As of 21/6/2019_

Drupal 8 module that enable see a node in a modal.

## Installation
Active the module in the Drupal administrator or in the Drush console:

```sh
drush en modal_content -y
```

## Mode of use
Insert the next code where you need de link that open the modal, $nid is the node id.

<code>
  $modal = \Drupal::service('modal.content');
  $form['modal'] = $modal->modalContentAdd('Open Modal', $nid);
</code>
