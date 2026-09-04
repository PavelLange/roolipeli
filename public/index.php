<?php

session_start();

$uri = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);
require_once "../models/campaigns.php";
require_once "../libraries/auth.php";
require_once "../controllers/userController.php";
require_once "../controllers/characterController.php";
require_once "../controllers/campaignController.php";


switch ($uri) {

    case '/':
        require __DIR__ . '/../partials/header.php';
        InvitationController();
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/login':
        require __DIR__ . '/../partials/header.php';
        loginController();
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/register':
        require __DIR__ . '/../partials/header.php';
        registerController();
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/campaigns':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/campaign.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/characters':
        require __DIR__ . '/../partials/header.php';
        require __DIR__ . '/../views/character.php';
        require __DIR__ . '/../partials/footer.php';
        break;


    case '/my-campaigns':
        if (isLoggedIn()) {
            require __DIR__ . '/../partials/header.php';
            viewCampaignsController();
            require __DIR__ . '/../partials/footer.php';
        } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require __DIR__ . '/../partials/footer.php';
        }
        break;

    case '/new-campaign':
        if (isLoggedIn()) {
            require __DIR__ . '/../partials/header.php';
            addCampaignController();
            require __DIR__ . '/../partials/footer.php';
        } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require __DIR__ . '/../partials/footer.php';
        }
        break;


    case '/new-character':
        if (isLoggedIn()) {
            require __DIR__ . '/../partials/header.php';
            addCharacterController();
            require __DIR__ . '/../partials/footer.php';
        } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require __DIR__ . '/../partials/footer.php';
        }
        break;


    case '/profile':
        require __DIR__ . '/../partials/header.php';

        if (isLoggedIn()) {
            require __DIR__ . '/../views/profile.php';
        } else {
            header('Location: /login');
            exit;
        }

        require __DIR__ . '/../partials/footer.php';
        break;


    case '/logout':
        if (isLoggedIn()) {
            logoutController();
        } else {
            header('Location: /');
            exit;
        }
        break;

        case '/edit-campaign':
            if(isLoggedIn()){
            if($method == "get"){
            require __DIR__ . '/../partials/header.php';
            editCampaignController();  
            require __DIR__ . '/../partials/footer.php';
            } else {
            updateCampaignController();
            }
            } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require_once __DIR__ . '/../partials/footer.php';
            }
        break;

        case '/edit-character':
            if(isLoggedIn()){
            if($method == "get"){
            require __DIR__ . '/../partials/header.php';
            editCharacterController();  
            require __DIR__ . '/../partials/footer.php';
            } else {
            updateCharacterController();
            }
            } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require_once __DIR__ . '/../partials/footer.php';
            }
        break;

        case '/view-character':
            if (isLoggedIn()) {
                if ($method === "get") {
                    require __DIR__ . '/../partials/header.php';
                    viewCharacterController();
                    require __DIR__ . '/../partials/footer.php';
                } else {
                    header("Location: /my-characters");
                    exit;
                }
            } else {
                require __DIR__ . '/../partials/header.php';
                loginController();
                require __DIR__ . '/../partials/footer.php';
            }
            break;
            

        case '/view-campaign':
            if(isLoggedIn()){
                
            if($method == "get"){
            require __DIR__ . '/../partials/header.php';
            viewCampaignController();  
            require __DIR__ . '/../partials/footer.php';
            } else {
            require __DIR__ . '/../partials/header.php';
            loginController();
            require_once __DIR__ . '/../partials/footer.php';
            }
            }
            break;


            case "/delete-campaign":
                if(isLoggedIn()) {
                    deleteCampaignController();
                } else {
                    loginController();
                }
            break;

            case "/delete-account":
                if(isLoggedIn()) {
                    deleteUserController();
                } else {
                    loginController();
                }
            break;

            case '/add-character-to-campaign':
                if (isLoggedIn() && $method === 'post') {
                    addCharacterToCampaignController();
                } else {
                    http_response_code(403);
                    echo "Not allowed";
                }
                break;

            case '/remove-character-from-campaign':
                if (isLoggedIn() && $method === 'post') {
                    removeCharacterFromCampaignController();
                } else {
                    http_response_code(403);
                    echo "Not allowed";
                }
            break;

            case '/delete-character':
                if (isLoggedIn()) {
                    deleteCharacterController();
                } else {
                    loginController();
                }
            break;

            case '/my-characters':
                if (isLoggedIn()) {
                    require __DIR__ . '/../partials/header.php';
            
                    myCharacterController();
            
                    require __DIR__ . '/../partials/footer.php';
                } else {
                    require __DIR__ . '/../partials/header.php';
            
                    loginController();
            
                    require __DIR__ . '/../partials/footer.php';
                }
                break;
        
    default:
        http_response_code(404);

        require __DIR__ . '/../partials/header.php';

        echo '<main class="container">';
        echo '<h1>404 - Page not found</h1>';
        echo '<p>The page you are looking for does not exist.</p>';
        echo '</main>';

        require __DIR__ . '/../partials/footer.php';
        break;
}
