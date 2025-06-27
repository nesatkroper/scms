<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\Department;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('department')->paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('subjects.create', compact('departments'));
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }

    public function show(Subject $subject)
    {
        $subject->load('department');
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $subject->load('department');
        $departments = Department::all();
        return view('subjects.edit', compact('subject', 'departments'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return redirect()->route('subjects.show', $subject)->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
}


//===============

// <?php

// namespace App\Http\Controllers;

// use App\Http\Requests\StoreSubjectRequest;
// use App\Http\Requests\UpdateSubjectRequest;
// use App\Models\Subject;
// use App\Models\Department;
// use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;

// class SubjectController extends Controller
// {
//     public function index(Request $request)
//     {
//         $search = $request->input('search');
//         $perPage = $request->input('per_page', 2);

//         $subjects = Subject::with('department')
//             ->when($search, function ($query) use ($search) {
//                 return $query->where('name', 'like', "%{$search}%")
//                     ->orWhere('code', 'like', "%{$search}%")
//                     ->orWhereHas('department', function ($q) use ($search) {
//                         $q->where('name', 'like', "%{$search}%");
//                     });
//             })
//             ->orderBy('created_at', 'desc')
//             ->paginate($perPage);

//         $departments = Department::all(); // Add this line

//         if ($request->ajax()) {
//             return response()->json([
//                 'html' => view('subjects.partials.table', compact('subjects', 'departments'))->render(),
//                 'pagination' => $subjects->links()->toHtml()
//             ]);
//         }

//         return view('subjects.index', compact('subjects', 'departments')); // Add departments here
//     }

//     public function create(): JsonResponse
//     {
//         $departments = Department::all();

//         return response()->json([
//             'html' => view('subjects.partials.create_form', compact('departments'))->render()
//         ]);
//     }

//     public function store(StoreSubjectRequest $request): JsonResponse
//     {
//         $subject = Subject::create($request->validated());

//         return response()->json([
//             'success' => true,
//             'message' => 'Subject created successfully!',
//             'subject' => $subject->load('department'),
//             'html' => view('subjects.partials.table_row', ['subject' => $subject])->render()
//         ]);
//     }

//     public function show(Subject $subject): JsonResponse
//     {
//         $subject->load('department');

//         return response()->json([
//             'subject' => $subject,
//             'created_at' => $subject->created_at->format('Y-m-d H:i:s'),
//             'updated_at' => $subject->updated_at->format('Y-m-d H:i:s'),
//             'html' => view('subjects.partials.show_details', compact('subject'))->render()
//         ]);
//     }

//     public function edit(Subject $subject): JsonResponse
//     {
//         $subject->load('department');
//         $departments = Department::all();

//         return response()->json([
//             'html' => view('subjects.partials.edit_form', compact('subject', 'departments'))->render()
//         ]);
//     }

//     public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
//     {
//         $subject->update($request->validated());

//         return response()->json([
//             'success' => true,
//             'message' => 'Subject updated successfully!',
//             'subject' => $subject->fresh('department'),
//             'html' => view('subjects.partials.table_row', ['subject' => $subject])->render()
//         ]);
//     }

//     public function destroy(Subject $subject): JsonResponse
//     {
//         $subject->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'Subject deleted successfully!',
//             'id' => $subject->id
//         ]);
//     }
// }

