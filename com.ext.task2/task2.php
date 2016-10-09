<?php

require_once 'task2.civix.php';

//hook_civicrm_navigationMenu
function task2_civicrm_navigationMenu(&$params) {
  //Check doesn't already exist
  $menu_item_search = array('url' => 'civicrm/a/#/Task');
  $menu_items = array();
  CRM_Core_BAO_Navigation::retrieve($menu_item_search, $menu_items);
 
  if ( ! empty($menu_items) ) { 
    return;
  }
 
  //Insert page at Memberships Menu
  $navId = CRM_Core_DAO::singleValueQuery("SELECT max(id) FROM civicrm_navigation");
  if (is_integer($navId)) {
    $navId++;
  }
  $membershipsID = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_Navigation', 'Memberships', 'id', 'name');
      $params[$membershipsID]['child'][$navId] = array (
        'attributes' => array (
          'label' => ts('Task 2: CiviCRM',array('domain' => 'com.ext.task2')),
          'name' => 'Memberships Details',
          'url' => 'civicrm/a/#/Task',
          'permission' => 'access CiviReport,access CiviContribute',
          'operator' => 'OR',
          'separator' => 1,
          'parentID' => $membershipsID,
          'navID' => $navId,
          'active' => 1
    )   
  );  
}


/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function task2_civicrm_config(&$config) {
  _task2_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function task2_civicrm_xmlMenu(&$files) {
  _task2_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function task2_civicrm_install() {
  _task2_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function task2_civicrm_uninstall() {
  _task2_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function task2_civicrm_enable() {
  _task2_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function task2_civicrm_disable() {
  _task2_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function task2_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _task2_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function task2_civicrm_managed(&$entities) {
  _task2_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function task2_civicrm_caseTypes(&$caseTypes) {
  _task2_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function task2_civicrm_angularModules(&$angularModules) {
_task2_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function task2_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _task2_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function task2_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function task2_civicrm_navigationMenu(&$menu) {
  _task2_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.ext.task2')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _task2_civix_navigationMenu($menu);
} // */
