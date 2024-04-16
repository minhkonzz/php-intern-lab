<?php 

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\UserService;
use App\Services\PersonService;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Person;

class UserController extends CRUDController 
{
    function __construct(UserService $userService, PersonService $personService)
    {
        parent::__construct($userService, 'users');
        $this->personService = $personService;
    }

    public function storeUser(StoreUserRequest $request): RedirectResponse
    {   
        $user = $this->service->create(
            $request->only(['name', 'email', 'password', 'is_active'])
        );

        $person = new Person();

        $user->person()->save($person);
        return redirect()->route('users.index');
    }

    public function showUser(User $user): View
    {
        return parent::show($user);
    }

    public function editUser(User $user): View
    {
        return parent::edit($user);
    }

    public function updateUser(StoreUserRequest $request, string $id): RedirectResponse
    {
        $this->service->update($request->only(['email', 'password', 'is_active']), $id);
        return redirect()->route('person.index')->with('success', 'Person updated');
    }
}