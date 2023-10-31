<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthUserFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri();
        $routeUser = $uri->getSegments()[0];
        $routeService = isset($uri->getSegments()[1]) ? $uri->getSegments()[1] : null;
        if($routeUser == 'aluno'){
            if(!session()->get('isLoggedIn') or session()->get('tipo') != 0){
                return redirect()->to(base_url());
            }
            if($routeService == "reservar" or $routeService == "pagamento"){
                if(session()->get('verificado') == 0 or session()->get('bloqueado') == 1) {
                    return redirect()->to(site_url('aluno/', METHOD));
                }
            }
            
        }
        else if($routeUser == 'cantina'){
            if(!session()->get('isLoggedIn') or session()->get('tipo') != 1){
                return redirect()->to(base_url());
            }
        }
        else if($routeUser == 'cae'){
            if(!session()->get('isLoggedIn') or session()->get('tipo') != 2){
                return redirect()->to(base_url());
            }
        }
        
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
