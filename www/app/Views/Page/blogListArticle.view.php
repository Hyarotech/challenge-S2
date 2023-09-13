<?php

use App\Models\Category;
use Core\Route;
?>
<div class="p-5">
    <div class="flex w-full flex-col gap-5 items-center">
        <h1 class="text-4xl text-center font-bold">Liste des articles</h1>
        <p><span class="badge flex font-bold text-center badge-secondary"><?= $categoryName ?></span></p>
        <a href="<?= \Core\Router::generateRoute('category') ?>" class="btn btn-sm btn-primary">Liste des catégories</a>
    </div>
    <div class="mt-10">
        <?php foreach($listArticle as $article): ?>
            <?php 
                $author = \App\Models\User::findBy('id',$article->getUserId());
                $authorName = strip_tags($author->getFirstName() . " " . $author->getLastName());

                $catPage = \App\Models\CatPage::findBy('page_id',$article->getId());
                $category = null;
                if($catPage)
                    $category = Category::findBy('id',$catPage->getCategoryId());
            ?>
            <div class="card">
                <div class="card-body hover:scale-105 transition-all bg-base-300 max-w-4xl w-full px-10 py-6 mx-auto rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <span class="text-sm dark:text-gray-400"><?= str_replace('-','/',$article->getCreatedAt()) ?></span>
                        <a href="<?= $category ? \Core\Router::generateDynamicRoute('blog.article.list',['cat_type' => $category->getName()]) : '#' ?>" class="badge hover:opacity-80 transition-all flex font-bold text-center badge-primary"><?= $category ? $category->getName() : 'Non catégorisé' ?></a>
                    </div>
                    <div class="mt-3">
                        <a href="<?= \Core\Router::generateDynamicRoute('page',['slug' => $article->getSlug()])?>" class="text-2xl font-bold hover:underline"><?= $article->getTitle() ?></a>
                        <p class="mt-2"><?= $article->getDescription(); ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="<?= \Core\Router::generateDynamicRoute('page',['slug' => $article->getSlug()])?>" class="hover:underline dark:text-violet-400">En savoir plus</a>
                        <div>
                            <span class="flex items-center">
                                <img src="https://source.unsplash.com/50x50/?portrait" alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full dark:bg-gray-500">
                                
                                <span class="hover:underline dark:text-gray-400"><?= $authorName ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>
