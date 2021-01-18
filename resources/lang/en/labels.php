<?php

return array (
  'backend' => 
  array (
   
   
    'subPackages' => 
    array (
      'title' => ' subscription packages',
      'fields' => 
      array (
        'title' => 'title',
        'slug' => 'slug',
        'price' => 'price',
        'duration' => 'duration',
        'description' => 'description',
        'status' => 'status',
      ),
      'view' => 'view',
      'create' => 'create',
    ),
  
    'access' => 
    array (
      'users' => 
      array (
        'user_actions' => 'User Actions',
        'management' => 'User Management',
        'change_password' => 'Change Password',
        'change_password_for' => 'Change Password for :user',
        'create' => 'Create User',
        'table' => 
        array (
          'abilities' => 'Abilities',
          'total' => 'user total|users total',
          'confirmed' => 'Confirmed',
          'created' => 'Created',
          'email' => 'E-mail',
          'id' => 'ID',
          'last_updated' => 'Last Updated',
          'name' => 'Name',
          'first_name' => 'First Name',
          'last_name' => 'Last Name',
          'no_deactivated' => 'No Deactivated Users',
          'no_deleted' => 'No Deleted Users',
          'other_permissions' => 'Other Permissions',
          'permissions' => 'Permissions',
          'roles' => 'Roles',
          'social' => 'Social',
          'status' => 'Status',
        ),
        'all_permissions' => 'All Permissions',
        'deactivated' => 'Deactivated Users',
        'deleted' => 'Deleted Users',
        'edit' => 'Edit User',
        'active' => 'Active Users',
        'view' => 'View User',
        'tabs' => 
        array (
          'titles' => 
          array (
            'overview' => 'Overview',
            'history' => 'History',
          ),
          'content' => 
          array (
            'overview' => 
            array (
              'avatar' => 'Avatar',
              'confirmed' => 'Confirmed',
              'created_at' => 'Created At',
              'deleted_at' => 'Deleted At',
              'email' => 'E-mail',
              'last_login_at' => 'Last Login At',
              'last_login_ip' => 'Last Login IP',
              'last_updated' => 'Last Updated',
              'name' => 'Name',
              'first_name' => 'First Name',
              'last_name' => 'Last Name',
              'status' => 'Status',
              'timezone' => 'Timezone',
            ),
          ),
        ),
        'no_permissions' => 'No Permissions',
        'no_roles' => 'No Roles to set.',
        'permissions' => 'Permissions',
        'select_role' => 'Select Role',
      ),
      'roles' => 
      array (
        'management' => 'Role Management',
        'create' => 'Create Role',
        'edit' => 'Edit Role',
        'table' => 
        array (
          'total' => 'role total|roles total',
          'number_of_users' => 'Number of Users',
          'permissions' => 'Permissions',
          'role' => 'Role',
          'sort' => 'Sort',
        ),
      ),
    ),
  ),

  'frontend' => 
  array (
  'modal' => 
  array (
    'new_user_note' => 'New User? Register Here',
    'registration_message' => 'Registration Successful. Please LogIn',
    'my_account' => 'My Account',
    'login_register' => '<a href="#" class="font-weight-bold go-login px-0">LOGIN</a> to our website, or <a href="#" class="font-weight-bold go-register px-0" id="">REGISTER</a>',
    'already_user_note' => 'Already a user? Login Here',
    'login_now' => 'LogIn Now',
    'register_now' => 'Register Now',
  ),
  'passwords' => 
  array (
    'reset_password_box_title' => 'Reset Password',
    'send_password_reset_link_button' => 'Send Password Reset Link',
    'expired_password_box_title' => 'Your password has expired.',
    'update_password_button' => 'Update Password',
    'reset_password_button' => 'Reset Password',
    'forgot_password' => 'Forgot Your Password?',
  ),

),
);
