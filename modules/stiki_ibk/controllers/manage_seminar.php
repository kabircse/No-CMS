<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Manage_Seminar
 *
 * @author No-CMS Module Generator
 */
class Manage_Seminar extends CMS_Priv_Strict_Controller {

    protected $URL_MAP = array();

    public function index(){
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // initialize groceryCRUD
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $crud = $this->new_crud();
        // this is just for code completion
        if (FALSE) $crud = new Grocery_CRUD();

        
        // unset things 
        $crud->unset_jquery();
        $crud->unset_read();
        // $crud->unset_add();
        // $crud->unset_edit();
        // $crud->unset_list();
        // $crud->unset_back_to_list();
        // $crud->unset_print();
        // $crud->unset_export();

        // set model
        $crud->set_model($this->cms_module_path().'/grocerycrud_seminar_model');

        // adjust groceryCRUD's language to No-CMS's language
        $crud->set_language($this->cms_language());

        // table name
        $crud->set_table($this->cms_complete_table_name('seminar'));

        // set subject
        $crud->set_subject('Seminar');

        // displayed columns on list
        $crud->columns('id_user','id_mahasiswa','alamat','email','telepon','id_status_bayar','keterangan_status_bayar');
        // displayed columns on edit operation
        $crud->edit_fields('id_user','id_mahasiswa','alamat','email','telepon','id_status_bayar','keterangan_status_bayar');
        // displayed columns on add operation
        $crud->add_fields('id_user','id_mahasiswa','alamat','email','telepon','id_status_bayar','keterangan_status_bayar');
        
        

        // caption of each columns
        $crud->display_as('id_user','User');
        $crud->display_as('id_mahasiswa','Mahasiswa');
        $crud->display_as('alamat','Alamat');
        $crud->display_as('email','Email');
        $crud->display_as('telepon','Telepon');
        $crud->display_as('id_status_bayar','Status Pembayaran');
        $crud->display_as('keterangan_status_bayar','Keterangan Status Bayar');

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put required field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/required_fields)
        // eg:
        //      $crud->required_fields( $field1, $field2, $field3, ... );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $crud->required_fields('id_user', 'id_mahasiswa', 'id_status_bayar');

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put required field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/unique_fields)
        // eg:
        //      $crud->unique_fields( $field1, $field2, $field3, ... );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $crud->unique_fields('id_mahasiswa');

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put field validation codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_rules)
        // eg:
        //      $crud->set_rules( $field_name , $caption, $filter );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put set relation (lookup) codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation)
        // eg:
        //      $crud->set_relation( $field_name , $related_table, $related_title_field , $where , $order_by );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$crud->set_relation('id_mahasiswa', $this->cms_complete_table_name('mahasiswa'), '{nrp} - {nama}');
		$crud->set_relation('id_status_bayar', $this->cms_complete_table_name('status_bayar'), 'nama');

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put set relation_n_n (detail many to many) codes here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/set_relation_n_n)
        // eg:
        //      $crud->set_relation_n_n( $field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table,
        //          $primary_key_alias_to_selection_table , $title_field_selection_table, $priority_field_relation );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put custom field type here
        // (documentation: http://www.grocerycrud.com/documentation/options_functions/field_type)
        // eg:
        //      $crud->field_type( $field_name , $field_type, $value  );
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$crud->field_type('id_user', 'hidden');


        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put callback here
        // (documentation: httm://www.grocerycrud.com/documentation/options_functions)
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $crud->callback_before_insert(array($this,'before_insert'));
        $crud->callback_before_update(array($this,'before_update'));
        $crud->callback_before_delete(array($this,'before_delete'));
        $crud->callback_after_insert(array($this,'after_insert'));
        $crud->callback_after_update(array($this,'after_update'));
        $crud->callback_after_delete(array($this,'after_delete'));



        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // HINT: Put custom error message here
        // (documentation: httm://www.grocerycrud.com/documentation/set_lang_string)
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // $crud->set_lang_string('delete_error_message', 'Cannot delete the record');
        // $crud->set_lang_string('update_error',         'Cannot edit the record'  );
        // $crud->set_lang_string('insert_error',         'Cannot add the record'   );

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // render
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $output = $crud->render();
        $this->view($this->cms_module_path().'/manage_seminar_view', $output,
            $this->cms_complete_navigation_name('manage_seminar'));

    }

    public function before_insert($post_array){
        return TRUE;
    }

    public function after_insert($post_array, $primary_key){
        $success = $this->after_insert_or_update($post_array, $primary_key);
        return $success;
    }

    public function before_update($post_array, $primary_key){
        return TRUE;
    }

    public function after_update($post_array, $primary_key){
        $success = $this->after_insert_or_update($post_array, $primary_key);
        return $success;
    }

    public function before_delete($primary_key){

        return TRUE;
    }

    public function after_delete($primary_key){
        return TRUE;
    }

    public function after_insert_or_update($post_array, $primary_key){

        return TRUE;
    }



}