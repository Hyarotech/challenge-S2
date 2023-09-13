<input type="hidden" id="GES_PAGE_TITLE" value="<?= $title ?>">
<input type="hidden" id="GES_PAGE_CREATED_AT" value="<?= $createdAt ?>">
<script src="https://cdn.tailwindcss.com/3.3.3"></script>

    <?php

                                                        use App\Models\User;

 if($pageType == \App\Configs\PageConfig::TYPE['article']): ?>
        <div class="flex flex-col items-center my-8 gap-2">
            <h1 class="text-4xl font-bold"><?= $title ?></h1>
            <p>Par <span class="text-accent font-bold" ><?= $author ?></span> le <?= str_replace('-','/',$createdAt) ?></p>
        </div>
    <?php endif; ?>

    <style>
    <?= $content->computedCSS ?>
    </style>

    <?= $content->computedHTML ?>

    <script defer>
    <?= $content->computedJs ?>
    </script>


<?php if($isCommentEnabled): ?>
    <p class="text-3xl my-10 font-bold">Espace commentaire</p>

    <div class="p-2 md:w-3/4 flex mx-auto gap-5 flex-col">
        <?php component('partials/Comment/commentForm',[
            'action' => \Core\Router::generateRoute('api.comment.create'),
            'pageId' => $pageId
        ],"view"); ?>

        <div class="space-y-4 bg-base-200 card p-5">

        <?php
            $commentList = \App\Models\Comment::findAllBy('page_id',$pageId);
            if($commentList)
                $commentList = \App\Models\Comment::resortRecent($commentList);
            
            foreach($commentList as $comment): 
                $user = User::findBy('id',$comment->getUserId());
                $userName = $user->getFirstName() ." ". $user->getLastName();
                 component('partials/Comment/commentBox',[
                    'author' => $userName,
                    'createdAt' => $comment->getCreatedAt(),
                    'message' => $comment->getMessage(),
                    'id' => $comment->getId()
                 ]);
            endforeach; 
        ?>
        </div>

    </div>
<?php endif; ?>