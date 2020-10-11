<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use App\User;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getUsersList",
     *      tags={"Users"},
     *      summary="Gets list of Users",
     *      description="Returns list of users",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */

    /**
     * Return full list of Users
     * @return Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * @OA\Post(
     *      path="/users",
     *      operationId="storeUser",
     *      tags={"Users"},
     *      summary="Stores a new User",
     *      description="Returns User store status",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="name",
     *          description="User Name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="gender",
     *          description="User Gender",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="User Country",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successfully Stored"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      )
     * )
     */

    /**
     * Create a new User
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $author = User::create($fields);

        return $this->validResponse($author, Response::HTTP_CREATED);
    }

     /**
     * @OA\Get(
     *      path="/users/{id}",
     *      operationId="getUserById",
     *      tags={"Users"},
     *      summary="Get User information",
     *      description="Returns author data",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      )
     * )
     */

    /**
     * Obtain and show one User
     * @return Illuminate\Http\Response
     */
    public function show($author){
        $author = User::findOrFail($author);

        return $this->validResponse($author);
    }

    /**
     * @OA\Put(
     *      path="/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update existing author",
     *      description="Returns updated author data",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\RequestBody(
     *         required=true,
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="persistent", type="boolean", example="true"),
     *         ),
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="User Name",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="gender",
     *          description="User Gender",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="User Country",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *          )
     *      )
     * )
     */

    /**
     * Update an existing User
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author){
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,'. $user,
            'password' => 'min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $author = User::findOrFail($author);
        $author->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if($author->isClean()){ //checks if nothing is changed
            return $this->errorResponse('Atleast one value must change', Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }
        $author->save();
        return $this->validResponse($author);
    }

    /**
     * @OA\Delete(
     *      path="/users/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete existing author",
     *      description="Deletes a author and returns no content",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="author id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *      )
     * )
     */

    /**
     * Remove an existing User
     * @return Illuminate\Http\Response
     */
    public function destroy($author){
        $author = User::findOrFail($author);
        $author->delete();
        return $this->validResponse($author);
    }

    /**
     * Identify existing User
     * @return Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
