<?php
/**
 *
 *
 * @package     PHP CAS
 * @subpackage  Adapter
 *
 * @author      Daniel Cousineau <danielc@doit.tamu.edu>
 * 
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright   © 2010 Department of IT, Division of Student Affairs, Texas A&M University
 */
class CAS_Zend_AuthAdapter implements Zend_Auth_Adapter_Interface
{
    /**
     *
     * @var CAS_Client
     */
    protected $casclient = null;

    public function __construct(CAS_Client $casclient = null)
    {
        $this->setCASClient($casclient);
    }

    /**
     * (non-PHPdoc)
     * @see Zend/Auth/Adapter/Zend_Auth_Adapter_Interface#authenticate()
     *
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        try
        {
            $ticket = $this->getCASClient()->login(null, false);

            if( $ticket === CAS_Client::REDIRECTED_FOR_LOGIN )
            {
                Zend_Controller_Front::getInstance()->getResponse()->setRedirect(
                    $this->getCASClient()->getCASLoginService(),
                    302
                );

                $result = new Zend_Auth_Result(
                    Zend_Auth_Result::FAILURE_UNCATEGORIZED,
                    null,
                    array(
                        'Redirected for login, waiting for ticket response...'
                    )
                );
            }
            else
            {
                $result = new Zend_Auth_Result(
                    Zend_Auth_Result::SUCCESS,
                    $ticket,
                    array()
                );
            }
        }
        catch( CAS_Exception $e )
        {
            $result = new Zend_Auth_Result(
                Zend_Auth_Result::FAILURE,
                null,
                (array)sprintf('%s',
                    $e->getMessage()
                )
            );
        }
        
        return $result;
    }

    /**
     *
     * @param $casclient
     * @return CAS_Zend_AuthAdapter *Provides a fluent interface*
     */
    public function setCASClient(CAS_Client $casclient)
    {
        $this->casclient = $casclient;
        return $this;
    }

    /**
     *
     * @return CAS_Client
     */
    public function getCASClient()
    {
        return $this->casclient;
    }
}