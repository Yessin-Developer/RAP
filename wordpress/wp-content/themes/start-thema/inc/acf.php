<?php
// ACF-ready: if ACF is active, this will load local JSON and register example fields.
// This file doesn't include ACF itself. Install ACF plugin (free) or ACF Pro.
if ( function_exists( 'acf_add_local_field_group' ) ) {
    // Example: add a field group for 'project' CPT
    acf_add_local_field_group(array(
        'key' => 'group_project_meta',
        'title' => 'Project meta',
        'fields' => array(
            array(
                'key' => 'field_project_url',
                'label' => 'Project URL',
                'name' => 'project_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_project_client',
                'label' => 'Client',
                'name' => 'project_client',
                'type' => 'text',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
                ),
            ),
        ),
    ));
}
