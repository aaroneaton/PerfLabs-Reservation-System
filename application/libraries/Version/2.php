<?php
/**
 * Class to facilitate communication with the CAS 2.0 server.
 * 
 * Version 2.0 merely requires the interpretation of an XML return value in the
 * following formats:
 * 
 * SUCCESS:
 * 
 * <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
 *    <cas:authenticationSuccess>
 *        <cas:NetID>netid</cas:NetID>
 *        <cas:UIN>#########</cas:UIN>
 *    </cas:authenticationSuccess>
 * </cas:serviceResponse>
 * 
 * FAILURE:
 * 
 * <cas:serviceResponse xmlns:cas='http://www.yale.edu/tp/cas'>
 *  <cas:authenticationFailure code="...">
 *    Optional authentication failure message
 *  </cas:authenticationFailure>
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
 
class CAS_Version_2 extends CAS_Version
{
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
            $ticket->setNetID($return_data->children($cas_namespace)->authenticationSuccess->NetID)
                   ->setUIN($return_data->children($cas_namespace)->authenticationSuccess->UIN);

            return $ticket;
        }
        else
        {
            throw new CAS_Exception("Possible Malformed CAS Response");
        }
    }
}