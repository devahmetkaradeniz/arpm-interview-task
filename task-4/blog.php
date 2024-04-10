<?php

//Enum
enum BlogStatus: string
{
    case PUBLISHED = 'published';
}

//Request 
class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:blog_posts,title,author_id,' . auth()->id(),
            'categoryId' => 'required|exists:categories,id'
        ];
    }
}

// Controller
class BlogController extends Controller {

    public function createPost(CreatePostRequest $request):JsonResponse{
        $post = BlogPost::create([
            'title' => $request->title,
            'author_id' => auth()->id(),
            'status' => BlogStatus::PUBLISHED->value
        ]);
        
        if(!$post){
            return response()->json([
                'success' => false,
                'message' => 'Could not create post!',
                'data' => null
            ]);
        }

        DB::table('post_categories')->insert([
            'post_id' => $post->id,
            'category_id' => $request->categoryId;
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'data' => $post
        ]);
    }
}


