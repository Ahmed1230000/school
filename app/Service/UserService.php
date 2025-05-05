<?php

namespace App\Service;


use App\Contracts\CustomeMessageInterface; // Contract for handling custom messages (success/error)
use App\Contracts\LogErrorInterface;       // Contract for logging errors
use App\Repositories\UserRepository; // The repository that handles the data logic for users
use App\Models\User; // The User model


class UserService
{

    // The UserService class is responsible for handling user-related operations.

    // Under the hood, it uses the UserRepository to interact with the database and perform CRUD operations.


    /**
     * @var UserRepository
     * The repository that handles the data logic for users.
     */
    protected $userRepository;

    /**
     * @var LogErrorInterface
     * The service that handles logging errors.
     */
    protected $logError;

    /**
     * @var CustomeMessageInterface
     * The service responsible for flashing messages (e.g., success or error messages).
     */
    protected $message;

    /**
     * Constructor to inject the dependencies into the service.
     * 
     * @param UserRepository $userRepository
     * @param LogErrorInterface $logError
     * @param CustomeMessageInterface $CustomeMessage
     */
    public function __construct(
        UserRepository $userRepository,
        LogErrorInterface $logError,
        CustomeMessageInterface $CustomeMessage
    ) {
        // Inject the dependencies into the service class
        $this->userRepository = $userRepository;
        $this->logError = $logError;
        $this->message = $CustomeMessage;
    }
}
