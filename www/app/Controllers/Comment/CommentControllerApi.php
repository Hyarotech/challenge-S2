<?php

namespace App\Controllers\Comment;

use App\Models\Comment;
use Core\IControllerApi;
use Core\Request;
use Core\ResourceJson; // Updated to use ResourceJson
use \Core\Session;
class CommentControllerApi implements IControllerApi
{
    public function readOne(Request $request): ResourceJson // Updated return type
    {
        $response = new ResourceJson(); // Updated to use ResourceJson

        /*    // Handle reading a single comment
            $commentId = $request->get('id');
            $comment = Comment::findBy('id',$commentId);

            $response = new ResourceJson(); // Updated to use ResourceJson

            if (!$comment) {
                $response->addError("comment", "Comment not found");
            } else {
                $response->assign("comment", $comment->toArray());
            }

            return $response;*/
            return $response;
    }

    public function readAll()
    {
        // Handle reading all comments
    }

    public function create(Request $request): ResourceJson
    {
        $comment = new Comment();
        $comment->setMessage($request->get('message'));
        $comment->setUserId(Session::get('user')['id']);
        $response = new ResourceJson();
        $pageId = $request->get('page_id');

        if(!\App\Models\Page::findBy('id',$pageId)){
            $response->addError('comment','la page n\'existe pas');
            return $response;
        }
        $comment->setPageId($request->get('page_id'));
      
        $result = Comment::save([
            'message' => $comment->getMessage(),
            'user_id' => $comment->getUserId(),
            'page_id' => $comment->getPageId()
        ]);
        
        if(!$result)
            $response->addError('comment','Le commentaire n\'a pas pu se créer');

        return $response;
    }

    public function update(Request $request): ResourceJson // Updated return type
    {
        // Handle comment update
        $commentId = $request->get('id');
        $comment = Comment::findBy('id',$commentId);

        $response = new ResourceJson(); // Updated to use ResourceJson

        if (!$comment) 
            $response->addError("comment", "Commentaire non trouvé");
        else {
            $comment->setMessage($request->get('message'));
            $comment->setUpdatedAt(date('Y-m-d H:i:s'));

            $result = Comment::update($commentId,[
                'message' => $comment->getMessage(),
                'updated_at' => $comment->getUpdatedAt()
            ]);
            
            if(!$result)
                $response->addError('comment','Le commentaire n\' a pas pû se mettre à jour');
        }

        return $response;
    }

    public function delete(Request $request): ResourceJson
    {
        // Handle comment deletion
        $commentId = $request->get('id');
        $comment = Comment::findBy('id',$commentId);

        $result = false;
        if ($comment) 
            $result = Comment::delete('id',$commentId);
        

        $response = new ResourceJson(); // Updated to use ResourceJson
        if(!$result)
            $response->addError('comment','impossible de supprimer');
        header('Content-Type: application/json');
        return $response;
    }
}
