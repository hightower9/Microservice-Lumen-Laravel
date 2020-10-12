<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Author;

class AuthorController extends Controller
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
     *      path="/authors",
     *      operationId="getAuthorsList",
     *      tags={"Authors"},
     *      summary="Gets list of Authors",
     *      description="Returns list of authors",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="author", type="object", ref="#/components/schemas/Author")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Unauthorized"),
     *              @OA\Property(property="code", type="string", example=401)
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Forbidden"),
     *              @OA\Property(property="code", type="string", example=403)
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="code", type="string", example=404)
     *          )
     *      )
     * )
     */

    /**
     * Return full list of Authors
     * @return Illuminate\Http\Response
     */
    public function index(){
        $authors = Author::all();

        return $this->successResponse($authors);
    }

    /**
     * @OA\Post(
     *      path="/authors",
     *      operationId="storeAuthor",
     *      tags={"Authors"},
     *      summary="Stores a new Author",
     *      description="Returns Author store status",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\RequestBody(
     *         required=true,
     *         description="Pass author details",
     *         @OA\JsonContent(
     *                 @OA\Property(property="author", type="object", ref="#/components/schemas/Author"),
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="author", type="object", ref="#/components/schemas/Author")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Data Successfully Created",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Unauthorized"),
     *              @OA\Property(property="code", type="string", example=401)
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Forbidden"),
     *              @OA\Property(property="code", type="string", example=403)
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="code", type="string", example=404)
     *          )
     *      )
     * )
     */

    /**
     * Create a new Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

     /**
     * @OA\Get(
     *      path="/authors/{id}",
     *      operationId="getAuthorById",
     *      tags={"Authors"},
     *      summary="Get Author information",
     *      description="Returns author data",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Author id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="author", type="object", ref="#/components/schemas/Author")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Unauthorized"),
     *              @OA\Property(property="code", type="string", example=401)
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Forbidden"),
     *              @OA\Property(property="code", type="string", example=403)
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="code", type="string", example=404)
     *          )
     *      )
     * )
     */

    /**
     * Obtain and show one Author
     * @return Illuminate\Http\Response
     */
    public function show($author){
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }

    /**
     * @OA\Put(
     *      path="/authors/{id}",
     *      operationId="updateAuthor",
     *      tags={"Authors"},
     *      summary="Update existing author",
     *      description="Returns updated author data",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\RequestBody(
     *         description="Pass user credentials",
     *         @OA\JsonContent(
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="persistent", type="boolean", example="true"),
     *         ),
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Author ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="author", type="object", ref="#/components/schemas/Author")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Unauthorized"),
     *              @OA\Property(property="code", type="string", example=401)
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Forbidden"),
     *              @OA\Property(property="code", type="string", example=403)
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="code", type="string", example=404)
     *          )
     *      )
     * )
     */

    /**
     * Update an existing Author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author){
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);
        $author->fill($request->all());

        if($author->isClean()){ //checks if nothing is changed
            return $this->errorResponse('Atleast one value must change', Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }
        $author->save();
        return $this->successResponse($author);
    }

    /**
     * @OA\Delete(
     *      path="/authors/{id}",
     *      operationId="deleteAuthor",
     *      tags={"Authors"},
     *      summary="Delete existing author",
     *      description="Deletes a author and returns no content",
     *      security={
     *         {
     *             "Bearer": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Author ID",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="author", type="object", ref="#/components/schemas/Author")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Unauthorized"),
     *              @OA\Property(property="code", type="string", example=401)
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Forbidden"),
     *              @OA\Property(property="code", type="string", example=403)
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="code", type="string", example=404)
     *          )
     *      )
     * )
     */

    /**
     * Remove an existing Author
     * @return Illuminate\Http\Response
     */
    public function destroy($author){
        $author = Author::findOrFail($author);
        $author->delete();
        return $this->successResponse($author);
    }
}
