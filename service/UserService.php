<?php

require_once '../repository/UserRepository.php';
require_once '../model/UserRegisterRequest.php';
require_once '../model/UserRegisterResponse.php';
require_once '../model/UserLoginRequest.php';
require_once '../model/UserLoginResponse.php';

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        $user = $this->userRepository->findByName($request->name);
        if ($user !== null) {
            throw new Exception('Username already exists.');
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);

        $this->userRepository->save($user);
        $response = new UserRegisterResponse();
        $response->user = $user;

        return $response;
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if ($request->name == null || $request->password == null ||
            trim($request->name) == null || trim($request->password) == "") {
            throw new Exception("name, password cannot blank!");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findByName($request->name);
        if ($user === null) {
            throw new Exception('Invalid username or password.');
        }

        if (!password_verify($request->password, $user->password)) {
            throw new Exception('Invalid username or password.');
        }
        return new UserLoginResponse($user);
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if ($request->name == null || $request->password == null ||
            trim($request->name) == "" || trim($request->password) == "") {
            throw new Exception("Name, Password can not blank");
        }
    }
}