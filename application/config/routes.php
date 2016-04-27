<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "auth";
$route['404_override'] = '';

/*
*	Auth Routes
*/
$route['login'] = 'auth/login_user';
$route['logout-admin'] = 'auth/logout';

/*
*	Admin Routes
*/
$route['dashboard'] = 'admin/dashboard';
$route['change-password'] = 'admin/users/change_password';

/*
*	administration Routes
*/
$route['administration/configuration'] = 'admin/configuration';
$route['administration/edit-configuration'] = 'admin/edit_configuration';
$route['administration/edit-configuration/(:num)'] = 'admin/edit_configuration/$1';
$route['administration/sections'] = 'admin/sections/index';
$route['administration/sections/(:any)/(:any)/(:num)'] = 'admin/sections/index/$1/$2/$3';
$route['administration/add-section'] = 'admin/sections/add_section';
$route['administration/edit-section/(:num)'] = 'admin/sections/edit_section/$1';

$route['administration/edit-section/(:num)/(:num)'] = 'admin/sections/edit_section/$1/$2';
$route['administration/delete-section/(:num)'] = 'admin/sections/delete_section/$1';
$route['administration/delete-section/(:num)/(:num)'] = 'admin/sections/delete_section/$1/$2';
$route['administration/activate-section/(:num)'] = 'admin/sections/activate_section/$1';
$route['administration/activate-section/(:num)/(:num)'] = 'admin/sections/activate_section/$1/$2';
$route['administration/deactivate-section/(:num)'] = 'admin/sections/deactivate_section/$1';
$route['administration/deactivate-section/(:num)/(:num)'] = 'admin/sections/deactivate_section/$1/$2';

#$route['administration/company-profile'] = 'admin/contacts/show_contacts';
$route['administration/branches'] = 'admin/branches/index';
$route['administration/branches/(:any)/(:any)/(:num)'] = 'admin/branches/index/$1/$2/$3';
$route['administration/branches/(:any)/(:any)'] = 'admin/branches/index/$1/$2';
$route['administration/add-branch'] = 'admin/branches/add_branch';
$route['administration/edit-branch/(:num)'] = 'admin/branches/edit_branch/$1';
$route['administration/edit-branch/(:num)/(:num)'] = 'admin/branches/edit_branch/$1/$2';
$route['administration/delete-branch/(:num)'] = 'admin/branches/delete_branch/$1';
$route['administration/delete-branch/(:num)/(:num)'] = 'admin/branches/delete_branch/$1/$2';
$route['administration/activate-branch/(:num)'] = 'admin/branches/activate_branch/$1';
$route['administration/activate-branch/(:num)/(:num)'] = 'admin/branches/activate_branch/$1/$2';
$route['administration/deactivate-branch/(:num)'] = 'admin/branches/deactivate_branch/$1';
$route['administration/deactivate-branch/(:num)/(:num)'] = 'admin/branches/deactivate_branch/$1/$2';

/*
*	HR Routes
*/
$route['human-resource/my-account'] = 'admin/dashboard';
$route['human-resource/my-account/edit-about/(:num)'] = 'hr/personnel/my_account/update_personnel_about_details/$1';
$route['human-resource/edit-personnel-account/(:num)'] = 'hr/personnel/update_personnel_account_details/$1';
$route['human-resource/configuration'] = 'hr/configuration';
$route['human-resource/add-job-title'] = 'hr/add_job_title';
$route['human-resource/edit-job-title/(:num)'] = 'hr/edit_job_title/$1';
$route['human-resource/delete-job-title/(:num)'] = 'hr/delete_job_title/$1';
$route['human-resource/personnel'] = 'hr/personnel/index';
$route['human-resource/personnel/(:any)/(:any)/(:num)'] = 'hr/personnel/index/$1/$2/$3';
$route['human-resource/add-personnel'] = 'hr/personnel/add_personnel';
$route['human-resource/edit-personnel/(:num)'] = 'hr/personnel/edit_personnel/$1';
$route['human-resource/edit-personnel-about/(:num)'] = 'hr/personnel/update_personnel_about_details/$1';
$route['human-resource/edit-personnel-account/(:num)'] = 'hr/personnel/update_personnel_account_details/$1';
$route['human-resource/edit-personnel/(:num)/(:num)'] = 'hr/personnel/edit_personnel/$1/$2';
$route['human-resource/delete-personnel/(:num)'] = 'hr/personnel/delete_personnel/$1';
$route['human-resource/delete-personnel/(:num)/(:num)'] = 'hr/personnel/delete_personnel/$1/$2';
$route['human-resource/activate-personnel/(:num)'] = 'hr/personnel/activate_personnel/$1';
$route['human-resource/activate-personnel/(:num)/(:num)'] = 'hr/personnel/activate_personnel/$1/$2';
$route['human-resource/deactivate-personnel/(:num)'] = 'hr/personnel/deactivate_personnel/$1';
$route['human-resource/deactivate-personnel/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel/$1/$2';
$route['human-resource/reset-password/(:num)'] = 'hr/personnel/reset_password/$1';
$route['human-resource/update-personnel-roles/(:num)'] = 'hr/personnel/update_personnel_roles/$1';
$route['human-resource/add-emergency-contact/(:num)'] = 'hr/personnel/add_emergency_contact/$1';
$route['human-resource/activate-emergency-contact/(:num)/(:num)'] = 'hr/personnel/activate_emergency_contact/$1/$2';
$route['human-resource/deactivate-emergency-contact/(:num)/(:num)'] = 'hr/personnel/deactivate_emergency_contact/$1/$2';
$route['human-resource/delete-emergency-contact/(:num)/(:num)'] = 'hr/personnel/delete_emergency_contact/$1/$2';

$route['human-resource/add-dependant-contact/(:num)'] = 'hr/personnel/add_dependant_contact/$1';
$route['human-resource/activate-dependant-contact/(:num)/(:num)'] = 'hr/personnel/activate_dependant_contact/$1/$2';
$route['human-resource/deactivate-dependant-contact/(:num)/(:num)'] = 'hr/personnel/deactivate_dependant_contact/$1/$2';
$route['human-resource/delete-dependant-contact/(:num)/(:num)'] = 'hr/personnel/delete_dependant_contact/$1/$2';

$route['human-resource/add-personnel-job/(:num)'] = 'hr/personnel/add_personnel_job/$1';
$route['human-resource/activate-personnel-job/(:num)/(:num)'] = 'hr/personnel/activate_personnel_job/$1/$2';
$route['human-resource/deactivate-personnel-job/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel_job/$1/$2';
$route['human-resource/delete-personnel-job/(:num)/(:num)'] = 'hr/personnel/delete_personnel_job/$1/$2';

$route['human-resource/leave'] = 'hr/leave/calender';
$route['human-resource/leave/(:any)/(:any)'] = 'hr/leave/calender/$1/$2';
$route['human-resource/view-leave/(:any)'] = 'hr/leave/view_leave/$1';
$route['human-resource/add-personnel-leave/(:num)'] = 'hr/personnel/add_personnel_leave/$1';
$route['human-resource/add-leave/(:any)'] = 'hr/leave/add_leave/$1';
$route['human-resource/add-calender-leave'] = 'hr/leave/add_calender_leave';
$route['human-resource/activate-leave/(:num)/(:any)'] = 'hr/leave/activate_leave/$1/$2';
$route['human-resource/deactivate-leave/(:num)/(:any)'] = 'hr/leave/deactivate_leave/$1/$2';
$route['human-resource/delete-leave/(:num)/(:any)'] = 'hr/leave/delete_leave/$1/$2';
$route['human-resource/activate-personnel-leave/(:num)/(:num)'] = 'hr/personnel/activate_personnel_leave/$1/$2';
$route['human-resource/deactivate-personnel-leave/(:num)/(:num)'] = 'hr/personnel/deactivate_personnel_leave/$1/$2';
$route['human-resource/delete-personnel-leave/(:num)/(:num)'] = 'hr/personnel/delete_personnel_leave/$1/$2';

$route['human-resource/delete-personnel-role/(:num)/(:num)'] = 'hr/personnel/delete_personnel_role/$1/$2';




/*
*	Inventory Routes
*/
$route['inventory/units-of-measurement'] = 'inventory/unit/index';
$route['inventory/units-of-measurement/(:any)/(:any)/(:num)'] = 'inventory/unit/index/$1/$2/$3';
$route['inventory/add-personnel'] = 'inventory/personnel/add_personnel';
$route['inventory/edit-personnel/(:num)'] = 'inventory/personnel/edit_personnel/$1';
$route['inventory/edit-personnel/(:num)/(:num)'] = 'inventory/personnel/edit_personnel/$1/$2';
$route['inventory/delete-personnel/(:num)'] = 'inventory/personnel/delete_personnel/$1';
$route['inventory/delete-personnel/(:num)/(:num)'] = 'inventory/personnel/delete_personnel/$1/$2';
$route['inventory/activate-personnel/(:num)'] = 'inventory/personnel/activate_personnel/$1';
$route['inventory/activate-personnel/(:num)/(:num)'] = 'inventory/personnel/activate_personnel/$1/$2';
$route['inventory/deactivate-personnel/(:num)'] = 'inventory/personnel/deactivate_personnel/$1';
$route['inventory/deactivate-personnel/(:num)/(:num)'] = 'inventory/personnel/deactivate_personnel/$1/$2';


/*
*	Personnel Roles Routes
*/
$route['human-resource/personnel-roles'] = 'hr/personnel_roles/index';
$route['human-resource/personnel-roles/(:any)/(:any)/(:num)'] = 'hr/personnel_roles/index/$1/$2/$3';
$route['human-resource/personnel-roles/(:any)/(:any)'] = 'hr/personnel_roles/index/$1/$2';
$route['human-resource/add-personnel-role'] = 'hr/personnel_roles/add_personnel_role';
$route['human-resource/edit-personnel-role/(:num)'] = 'hr/personnel_roles/edit_personnel_role/$1';
$route['human-resource/delete-personnel-role/(:num)'] = 'hr/personnel_roles/delete_personnel_role/$1';
$route['human-resource/delete-personnel-role/(:num)/(:num)'] = 'hr/personnel_roles/delete_personnel_role/$1/$2';
$route['human-resource/activate-personnel-role/(:num)'] = 'hr/personnel_roles/activate_personnel_role/$1';
$route['human-resource/activate-personnel-role/(:num)/(:num)'] = 'hr/personnel_roles/activate_personnel_role/$1/$2';
$route['human-resource/deactivate-personnel-role/(:num)'] = 'hr/personnel_roles/deactivate_personnel_role/$1';
$route['human-resource/deactivate-personnel-role/(:num)/(:num)'] = 'hr/personnel_roles/deactivate_personnel_role/$1/$2';


$route['gbm-administration/departments'] = 'gbm_administration/departments/index';
$route['gbm-administration/departments/(:any)/(:any)/(:num)'] = 'gbm_administration/departments/index/$1/$2/$3';
$route['gbm-administration/departments/(:any)/(:any)'] = 'gbm_administration/departments/index/$1/$2';
$route['gbm-administration/add-department'] = 'gbm_administration/departments/add_department';
$route['gbm-administration/edit-department/(:num)'] = 'gbm_administration/departments/edit_department/$1';
$route['gbm-administration/delete-department/(:num)'] = 'gbm_administration/departments/delete_department/$1';
$route['gbm-administration/activate-department/(:num)'] = 'gbm_administration/departments/activate_department/$1';
$route['gbm-administration/deactivate-department/(:num)'] = 'gbm_administration/departments/deactivate_department/$1';



$route['gbm-administration/counties'] = 'gbm_administration/counties/index';
$route['gbm-administration/counties/(:any)/(:any)/(:num)'] = 'gbm_administration/counties/index/$1/$2/$3';
$route['gbm-administration/counties/(:any)/(:any)'] = 'gbm_administration/counties/index/$1/$2';
$route['gbm-administration/add-county'] = 'gbm_administration/counties/add_county';
$route['gbm-administration/edit-county/(:num)'] = 'gbm_administration/counties/edit_county/$1';
$route['gbm-administration/delete-county/(:num)'] = 'gbm_administration/counties/delete_county/$1';
$route['gbm-administration/activate-county/(:num)'] = 'gbm_administration/counties/activate_county/$1';
$route['gbm-administration/deactivate-county/(:num)'] = 'gbm_administration/counties/deactivate_county/$1';



$route['gbm-administration/nurseries'] = 'gbm_administration/nurseries/index';
$route['gbm-administration/nurseries/(:any)/(:any)/(:num)'] = 'gbm_administration/nurseries/index/$1/$2/$3';
$route['gbm-administration/nurseries/(:any)/(:any)'] = 'gbm_administration/nurseries/index/$1/$2';
$route['gbm-administration/add-nursery'] = 'gbm_administration/nurseries/add_nursery';
$route['gbm-administration/edit-nursery/(:num)'] = 'gbm_administration/nurseries/edit_nursery/$1';
$route['gbm-administration/delete-nursery/(:num)'] = 'gbm_administration/nurseries/delete_nursery/$1';
$route['gbm-administration/activate-nursery/(:num)'] = 'gbm_administration/nurseries/activate_nursery/$1';
$route['gbm-administration/deactivate-nursery/(:num)'] = 'gbm_administration/nurseries/deactivate_nursery/$1';


$route['tree-planting/community-groups/(:num)'] = 'gbm_administration/community_groups/index/$1';
$route['tree-planting/community-groups/(:num)/(:any)/(:any)/(:num)'] = 'gbm_administration/community_groups/index/$1/$2/$3/$3';
$route['tree-planting/community-groups/(:num)/(:any)/(:any)'] = 'gbm_administration/community_groups/index/$1/$2/$3';
$route['tree-planting/add-community-group/(:num)'] = 'gbm_administration/community_groups/add_community_group/$1';
$route['tree-planting/edit-community-group/(:num)/(:num)'] = 'gbm_administration/community_groups/edit_community_group/$1/$2';
$route['tree-planting/delete-community-group/(:num)/(:num)'] = 'gbm_administration/community_groups/delete_community_group/$1/$2';
$route['tree-planting/activate-community-group/(:num)/(:num)'] = 'gbm_administration/community_groups/activate_community_group/$1/$2';
$route['tree-planting/deactivate-community-group/(:num)/(:num)'] = 'gbm_administration/community_groups/deactivate_community_group/$1/$2';


$route['tree-planting/group-members/(:num)/(:num)'] = 'gbm_administration/group_members/index/$1/$2';
$route['tree-planting/add-group-member/(:num)/(:num)'] = 'gbm_administration/group_members/add_group_member/$1/$2';
$route['tree-planting/edit-group-member/(:num)/(:num)/(:num)'] = 'gbm_administration/group_members/edit_group_member/$1/$2/$3';
$route['tree-planting/delete-group-member/(:num)/(:num)/(:num)'] = 'gbm_administration/group_members/delete_group_member/$1/$2/$3';
$route['tree-planting/activate-group-member/(:num)/(:num)/(:num)'] = 'gbm_administration/group_members/activate_group_member/$1/$2/$3';
$route['tree-planting/deactivate-group-member/(:num)/(:num)/(:num)'] = 'gbm_administration/group_members/deactivate_group_member/$1/$2/$3';



$route['tree-planting/projects'] = 'projects/index';
$route['tree-planting/projects/(:num)'] = 'tree-planting/projects/index/$1';
$route['tree-planting/add-project'] = 'projects/add_project';
$route['tree-planting/project-detail/(:num)/(:any)'] = 'projects/project_detail/$1/$2';
$route['tree-planting/update-order-item/(:num)/(:any)/(:num)'] = 'tree-planting/projects/update_order_item/$1/$2/$3';
$route['tree-planting/update-supplier-prices/(:num)/(:any)/(:num)'] = 'tree-planting/projects/update_supplier_prices/$1/$2/$3';
$route['tree-planting/send-for-correction/(:num)'] = 'tree-planting/projects/send_order_for_correction/$1';
$route['tree-planting/send-for-approval/(:num)'] = 'tree-planting/projects/send_order_for_approval/$1';
$route['tree-planting/send-for-approval/(:num)/(:num)'] = 'tree-planting/projects/send_order_for_approval/$1/$2';
$route['tree-planting/submit-supplier/(:num)/(:any)'] = 'tree-planting/projects/submit_supplier/$1/$2';
$route['tree-planting/generate-lpo/(:num)'] = 'tree-planting/projects/print_lpo_new/$1';
$route['tree-planting/generate-rfq/(:num)/(:num)/(:any)'] = 'tree-planting/projects/print_rfq_new/$1/$2/$3';
$route['tree-planting/edit_order/(:num)'] = 'tree-planting/projects/edit_order/$1';




$route['tree-planting/project-areas'] = 'projects/project_areas/index';
$route['tree-planting/project-areas/(:any)/(:any)/(:num)'] = 'projects/project_areas/index/$1/$2/$3';
$route['tree-planting/project-areas/(:any)/(:any)'] = 'projects/project_areas/index/$1/$2';
$route['tree-planting/add-project-area'] = 'projects/project_areas/add_project_area';
$route['tree-planting/edit-project-area/(:num)'] = 'projects/project_areas/edit_project_area/$1';
$route['tree-planting/delete-project-area/(:num)'] = 'projects/project_areas/delete_project_area/$1';
$route['tree-planting/activate-project-area/(:num)'] = 'projects/project_areas/activate_project_area/$1';
$route['tree-planting/deactivate-project-area/(:num)'] = 'projects/project_areas/deactivate_project_area/$1';
$route['tree-planting/project-area-detail/(:num)'] = 'projects/project_areas/project_area_detail/$1';



$route['tree-planting/area-locations/(:num)'] = 'projects/project_areas/area_locations/$1';
$route['tree-planting/add-area-location/(:num)'] = 'projects/project_areas/add_area_location/$1';
$route['tree-planting/edit-area-location/(:num)/(:num)'] = 'projects/project_areas/edit_project_area/$1/$2';
$route['tree-planting/delete-area-location/(:num)/(:num)'] = 'projects/project_areas/delete_area_location/$1/$2';
$route['tree-planting/activate-area-location/(:num)/(:num)'] = 'projects/project_areas/activate_area_location/$1/$2';
$route['tree-planting/deactivate-area-location/(:num)/(:num)'] = 'projects/project_areas/deactivate_area_location/$1/$2';


$route['tree-planting/trainings/(:num)'] = 'projects/meeting/index/$1';
$route['tree-planting/add-training/(:num)'] = 'projects/meeting/add_meeting/$1';
$route['tree-planting/edit-training/(:num)/(:num)'] = 'projects/meeting/edit_training/$1/$2';
$route['tree-planting/delete-training/(:num)/(:num)'] = 'projects/meeting/delete_training/$1/$2';
$route['tree-planting/activate-training/(:num)/(:num)'] = 'projects/meeting/activate_training/$1/$2';
$route['tree-planting/deactivate-training/(:num)/(:num)'] = 'projects/meeting/deactivate_training/$1/$2';


$route['training-attendees/(:num)/(:num)'] = 'projects/meeting/training_attendees/$1/$2';
$route['add-neeting-attendee/(:num)/(:num)'] = 'projects/meeting/add_meeting_attendee/$1/$2';




$route['tree-planting/seedling-production/(:num)'] = 'projects/seedling_production/index/$1';
$route['tree-planting/seedling-production/(:num)/(:any)/(:any)/(:num)'] = 'projects/seedling_production/index/$1/$2/$3/$3';
$route['tree-planting/seedling-production/(:num)/(:any)/(:any)'] = 'projects/seedling_production/index/$1/$2/$3';
$route['tree-planting/add-seedling-production/(:num)'] = 'projects/seedling_production/add_seedling_production/$1';
$route['tree-planting/edit-seedling-production/(:num)/(:num)'] = 'projects/seedling_production/edit_seedling_production/$1/$2';
$route['tree-planting/delete-seedling-production/(:num)/(:num)'] = 'projects/seedling_production/delete_seedling_production/$1/$2';
$route['tree-planting/activate-seedling-production/(:num)/(:num)'] = 'projects/seedling_production/activate_seedling_production/$1/$2';
$route['tree-planting/deactivate-seedling-production/(:num)/(:num)'] = 'projects/seedling_production/deactivate_seedling_production/$1/$2';


$route['tree-planting/seedling-tally/(:num)/(:num)'] = 'projects/seedling_production/tally_sheet/$1/$2';
$route['tree-planting/seedling-production/(:num)/(:any)/(:any)/(:num)'] = 'projects/seedling_production/index/$1/$2/$3/$3';
$route['tree-planting/add-tally-numbers/(:num)/(:num)'] = 'projects/seedling_production/add_seedling_production_tally/$1/$2';


$route['tree-planting/ctn-detail/(:num)'] = 'projects/ctn/index/$1';
$route['tree-planting/add-ctn/(:num)'] = 'projects/ctn/add_ctn/$1';
$route['tree-planting/ctn-new-order/(:num)/(:num)'] = 'projects/ctn/new_ctn_order/$1/$2';
$route['tree-planting/ctn-orders/(:num)/(:num)'] = 'projects/ctn/ctn_orders/$1/$2';
$route['tree-planting/get-order-items/(:num)'] = 'projects/ctn/get_order_items/$1';
$route['tree-planting/add-order-item/(:num)/(:num)/(:num)'] = 'projects/ctn/add_order_item/$1/$2/$3';
$route['tree-planting/add-order-receivables/(:num)/(:num)/(:num)'] = 'projects/ctn/add_order_receivables/$1/$2/$3';