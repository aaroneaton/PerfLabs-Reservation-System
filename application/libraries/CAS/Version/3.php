<?php
/**
 * Class to facilitate communication with the CAS 3.0 server.
 * 
 * Version 3.0 merely requires the interpretation of an XML return value in the
 * following formats:
 * 
 * SUCCESS:
 * 
 * <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
 *   <cas:authenticationSuccess>
 *     <cas:user>netid</cas:user>
 *     <cas:attributes>
 *       <cas:tamuEduPersonUIN>#########</cas:tamuEduPersonUIN>
 *       <cas:tamuEduPersonNetID>netid</cas:tamuEduPersonNetID>
 *     </cas:attributes>
 *   </cas:authenticationSuccess>
 * </cas:serviceResponse>
 * 
 * FAILURE:
 * 
 * <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
 *     <cas:authenticationFailure code="...">
 *     Optional authentication failure message
 *     </cas:authenticationFailure>
 * </cas:serviceResponse>
 *
 *
 * @package     PHPCAS
 * @subpackage  Version
 *
 * @author      Daniel Cousineau <danielc@doit.tamu.edu>
 * 
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright   © 2010 Department of IT, Division of Student Affairs, Texas A&M University
 */
 
class CAS_Version_3 extends CAS_Version
{
    /**
     * @var boolean
     */
    protected $_renew = false;

    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }

    /**
     * Overrides parent getCASLoginService()
     *
     * @return string
     */
    public function getCASLoginService()
    {
        $loginService = parent::getCASLoginService();

        if( $this->getRenew() )
            $loginService .= "&renew=true";

        return $loginService;
    }

    /**
     * Validates a given ticket and returns the validated ticket with the user
     * credentials.
     * 
     * Throws a CAS_Exception on validation errors
     * 
     * @param CAS_Ticket $ticket
     * @return CAS_Ticket Validated Ticket
     * @throws CAS_Exception
     */
    public function validateTicket(CAS_Ticket $ticket = null)
    {
        if( !$ticket )
            $ticket = CAS_Ticket::createFromGET();
        
        $output = $this->getClient()->curl_fetch($this->getCASValidateService($ticket));

        $return_data = simplexml_load_string($output);
        
        $cas_namespace = $return_data->getDocNamespaces();
        $cas_namespace = $cas_namespace['cas'];
        
        if( isset($return_data->children($cas_namespace)->authenticationFailure) )
        {
            throw new CAS_Exception($return_data->children($cas_namespace)->authenticationFailure);
        }
        elseif( isset($return_data->children($cas_namespace)->authenticationSuccess) )
        {
            $ticket->setNetID($return_data->children($cas_namespace)->authenticationSuccess->attributes->tamuEduPersonNetID)
                   ->setUIN($return_data->children($cas_namespace)->authenticationSuccess->attributes->tamuEduPersonUIN);
            
            return $ticket;
        }
        else
        {
            throw new CAS_Exception("Possible Malformed CAS Response");
        }
    }
    
    /**
     * Set whether or not to set the renew flag. The renew flag instructs CAS
     * to require the user to re-authenticate for your application.
     *
     * @param boolean $renew
     * @return CAS_Client
     */
    public function setRenew($renew)
    {
        $this->_renew = (boolean)$renew;
        return $this;
    }

    /**
     * Return whether or not to set the renew flag
     *
     * @return boolean
     */
    public function getRenew()
    {
        return $this->_renew;
    }
}