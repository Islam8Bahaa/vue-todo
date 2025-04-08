<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $todoList = Todo::when($request->filled('status'), fn(Builder $queryBuilder) => $queryBuilder->where('status', $request->status))
            ->when($request->get('query'), function (Builder $query, $searchQuery) use ($request) {
                $query->where(function (Builder $query) use ($searchQuery) {
                    $query->where('title', 'like', "%$searchQuery%");
                });
            })
            ->when($request->priority, fn(Builder $query, $searchQuery) => $query->where('priority', $searchQuery))
            ->paginate($request->get('perPage', 25));
        $todoCollection = TodoResource::collection($todoList->items());
        $extra = [
            'has_more' => $todoList->hasMorePages(),
        ];
        $todoList = $todoList->toArray();
        $todoList['data'] = $todoCollection;
        return response()->json($todoList + $extra);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        Todo::create($request->validated());
        return 'created';
    }


    public function show(Todo $todo)
    {
        return $todo;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());
        return 'updated';
    }

    public function changeStatus(Request $request, Todo $todo)
    {
        $todo->update([
            'status' => $request->boolean('status')
        ]);
        return 'updated';
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return 'deleted';
    }
}
