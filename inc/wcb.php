<?php 
if(isset($_GET['numero']))
{
    $_POST['numero'] = $_GET['numero']; // a optimiser
    
    $_POST['numero'] = str_replace('.', '', $_POST['numero']);
    	
    try 
    {
        $soap = new SoapClient("https://www.ovh.com/soapi/soapi-re-1.21.wsdl");
        
        $_POST['numero'] = "0033".substr($_POST['numero'],1,10);
        
        //telephonyClick2CallDo
        $soap->telephonyClick2CallDo("capretraite", "zpl4jllm", $_POST['numero'], "0033141164970", "0033183646141");
        echo "Merci de patienter, un conseiller va vous répondre\n";
	} 
    
    catch(SoapFault $fault) 
    {
        //echo $fault;
        echo "Nous n'avons pas réussi à vous joindre.";
	}
}
?>