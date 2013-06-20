<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contactaction_model extends CRM_Model {
     public $fields_for_search = array
            (
                'contact.Id' => 'cId',
                'contact.FirstName' => 'First Name',
                'contact.LastName' => 'Last Name',
                'contactaction.ContactId' => 'CID',
                'contactaction._ActionSubtype' => 'Role',
                'contactaction._ValidUntil' => 'Season',
                //'contactaction.Cread' => 'Date Created',
            );
    public $fields_for_export = array
            (
                'contact.Id' => 'cId',
                'contact._IsOrganisationYN' => 'Org YN',
                'contact.Title' => 'Title',
                'contact.FirstName' => 'First Name',
                'contact.LastName' => 'Last Name',
                'contact.Nickname' => 'Known As',
                'contact.Email' => 'Email 1',
                'contact.EmailAddress2' => 'Email 2',
                'contact._Gender' => 'Gender',
                'contact.Birthday' => 'DoB',
                'contact._LegacyMembershipNo' => 'Memb No',
                'contact._OrganisationName' => 'Org Name',
                'contact.StreetAddress1' => 'Address 1',
                'contact.StreetAddress2' => 'Address 2',
                'contact._StreetAddress3' => 'Address 3',
                'contact.City' => 'Town',
                'contact.State' => 'County',
                'contact.Country' => 'Country',
                'contact.PostalCode' => 'Postcode',
                'contact.Phone1' => 'Landline',
                'contact.Phone2' => 'Home',
                'contact.Phone3' => 'Mobile',
                'contact.Phone4' => 'Overseas',
                'contact._TwitterName' => 'Twitter',
                'contact._OptinEmailYN' => 'Email Opt In YN',
                'contact._OptinSmsYN' => 'SMS Opt In YN',
                'contact._OptinTwitterYN' => 'Twitter Opt In YN',
                'contact._OptinSurfaceMailYN' => 'Post Opt In YN',
                'contact._OptinNewsletterYN' => 'Newsletter Opt In YN',
                'contact._OptinMerchandiseYN' => 'Mechandise Opt In YN',
                'contact._OptinOtherYN' => 'Away Match Opt In YN',
                'contactaction.ContactId' => 'CID',
                'contactaction._ActionSubtype' => 'Role',
                'contactaction._ValidUntil' => 'Season',
                'contact._ActiveRecordYN' => 'Active_record',
                'contactaction._ActiveRecordYN' => 'Active_record',
            );

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contactaction';
        $this->order_by = 'ActionDate DESC';
        $this->contactId_fieldname = 'ContactId';
        $this->action_date_fieldname = 'ActionDate';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
        
        //THIS SI FROM THE SESSION !!!
        $this->current_UserId = '';
        

        //We can maybe move htis MY_MODEL?
        if (isset($this->data['view_setup']['user_data']['UserId']))
        {
            $this->current_UserId = $this->data['view_setup']['user_data']['UserId'];
        }
    }
    
    public function get_roles_join($export = FALSE, $limit, $start) {
       $criteria = array();
       
       if ($this->input->post())
       {
           $search_criteria = $this->input->post();
       }
       elseif ($this->session->userdata('search_criteria'))
       {
           $search_criteria = $this->session->userdata('search_criteria');
       }
       else return FALSE;
       
       //print_array($search_criteria);
       
       //Get criteria
       foreach ($search_criteria as $k => $v)
       {
           if ($v !== '0')
           {
               switch ($k)
                {
                    case 'role_type':
                        /*if ($search_criteria['role_type2'])
                        {
                            $criteria['contactaction._ActionSubtype'] 
                        }*/
                        $criteria['contactaction._ActionSubtype'] = $v;
                        break;
                    case 'role_type_2':
                        if ($v) $this->db->where('contactaction._ActionSubtype', $v);
                        break;
                    
                    case 'role_expire':
                        $criteria['contactaction._ValidUntil'] = $v;
                        break;

                    default:
                        break;
                }
           }
           
       }
       
       //print_array($criteria, 1,'criteria');
       $this->session->set_userdata('search_criteria', $search_criteria);
       //$_SESSION['test'] = 1;
       //Set up & do query
       if ( ! $export) $this->db->select(array_keys($this->fields_for_search));
       else $this->db->select(array_keys($this->fields_for_export));
       
       //$this->order_by = 'contact.LastName ASC';
       if ($limit) $this->db->limit($limit, $start);
        //foreach ($criteria as $k => $array) $this->db->where($array);
       //print_array($criteria, 1);
       $this->db->where($criteria);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('contactaction._ActiveRecordYN', 1);
       $this->db->join('contact', 'contact.Id = contactaction.ContactId');
       
       if ($export)
       {
            $retval['result'] = $this->db->get($this->table_name);
            $this->load->dbutil();
            $retval['csv'] = $this->dbutil->csv_from_result($retval['result'], ",","\n");
       }
       else
       {
            $retval['table_data'] = $this->db->get($this->table_name)->result_array();
            
            //finally, turn array inot one that's understood by the table function
            foreach ($this->fields_for_search as $col => $label)
            {
                $boom = '';
                $boom = explode('.', $col);
                $retval['table_headers'][$boom[1]] = $label;
            }
       }
       
       //do count
        $this->db->where($criteria);
        $this->db->from($this->table_name);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('contactaction._ActiveRecordYN', 1);
        $this->db->join('contact', 'contact.Id = contactaction.ContactId');
        $retval['count'] = $this->db->count_all_results();
       
       return $retval;
    }
    
    
    /*function add($input, $rID) {
       if ($rID == 'new')
       {
          $rID = NULL;
       }      
       
       return $this->save($input, $rID);
    }
     * moved this to MY_MOdel
     */
    
    function joinon_Contact_and_Vehicle($where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__vehicles', 
                '__vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );   
        return $this->get();
    }
    
    function get_todays_bookings($where = NULL) {
        $this->db->where('ActionDate >=', date('Y-m-d 00:00:00', $this->current_day));
        $this->db->where('ActionDate <=', date('Y-m-d 23:59:59' , $this->current_day));
        $this->db->where('ActionType =', 'Booking');
        $result = $this->joinon_Contact_and_Vehicle($where);
        //Sort these into an array sorted by _Status
        foreach ($result as $k => $array)
        {
            $time = explode(' ', $array['ActionDate']);
            $array['time'] = substr($time[1], 0, -3);
            if ( isset($array['_Status'] )) $status = intval($array['_Status']);
            else $status = 0;
            $result['retval'][$status][$array['time']] = $array;
        }
        
        //just make sure that an empty array is returned if no records exists
        if ( ! array_key_exists('retval', $result)) $result['retval'] = array();
        
        return $result['retval'];
    }
    
    function joinon_Contact_and_Vehicle_singlerecord($rID, $where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__vehicles', 
                '__vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );        
        return $this->get($rID);
    }
    
    function get_all_tasks($where = NULL) {
        if ($where != NULL) { $this->db->where($where); }
        $this->db->join('contact', 'contact.Id = ' . $this->table_name . '.ContactId', 'left' );
        $this->db->join('contact c', 'c.Id = ' . $this->table_name . '.UserID', 'left' );
        return $this->get();
    }
    
    function get_users_tasks($where = NULL) {
        $this->db->where(
            'UserID', 
            $this->session->userdata('Id')
            );
        
        return $this->get_all_tasks($where);
    }
    
    function get_all_users_records($where = NULL){
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where(
                'UserID', 
                $this->current_UserId
                );
        return $this->get();
    }
     
   
    

}