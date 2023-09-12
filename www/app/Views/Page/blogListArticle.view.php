<?php

use Core\Route;
?>
<div class="p-5">
    <div class="flex w-full flex-col items-center">
        <h1 class="text-4xl text-center font-bold mb-5">Liste des articles</h1>
        <p><span class="badge flex font-bold text-center badge-primary"><?= $categoryName ?></span></p>
    </div>
    <div class="mt-10">
        <?php foreach($listArticle as $article): ?>
            <div class="card ">
                <div class="card-body bg-base-300 max-w-4xl px-10 py-6 mx-auto rounded-lg shadow-sm dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <span class="text-sm dark:text-gray-400">Jun 1, 2020</span>
                        <a rel="noopener noreferrer" href="#" class="px-2 py-1 font-bold rounded dark:bg-violet-400 dark:text-gray-900">Javascript</a>
                    </div>
                    <div class="mt-3">
                        <a rel="noopener noreferrer" href="#" class="text-2xl font-bold hover:underline">Nos creasse pendere crescit angelos etc</a>
                        <p class="mt-2">Tamquam ita veritas res equidem. Ea in ad expertus paulatim poterunt. Imo volo aspi novi tur. Ferre hic neque vulgo hae athei spero. Tantumdem naturales excaecant notaverim etc cau perfacile occurrere. Loco visa to du huic at in dixi aër.</p>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a rel="noopener noreferrer" href="#" class="hover:underline dark:text-violet-400">Read more</a>
                        <div>
                            <a rel="noopener noreferrer" href="#" class="flex items-center">
                                <img src="https://source.unsplash.com/50x50/?portrait" alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full dark:bg-gray-500">
                                <span class="hover:underline dark:text-gray-400">Leroy Jenkins</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>
