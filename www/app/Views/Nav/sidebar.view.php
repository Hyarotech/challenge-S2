<div class="sidebar left-0 fixed z-50 top-0 hidden md:inline-flex h-full w-[80px] text-base-content bg-base-300">
<style>
    /** C'EST JUSTE POUR LA DEMO, DU FONCTIONNEMENT NAVBAR CE SERA A SUPPRIME AVEC les classes .testNav0 et .testNav
        DE PLUS CE SERA NON PAS SUR LA NAV LE HOVER MAIS SUR LES BOUTONS
    **/
    .sidebar:hover .subSideBar{
            display:block!important;
    }
</style>
    <div class=" flex flex-col sidebarFirstSection w-[80px] h-full">
        <div class="hidden md:flex justify-center items-center h-[64px]  p-3">
            <img src="./vite.svg" class="w-full h-full"/>
        </div>
        <div class="sidebarMobileHide md:hidden w-full sm:flex justify-center items-center h-[64px]  p-3">
                <button class="btn z-51 m-auto btn-square btn-ghost">
                    <i class="fa-solid fa-xmark text-3xl"></i>
                </button>
        </div>
        <div class="flex flex-col flex-grow items-center justify-center overflow-auto gap-3 py-4 ">
           <?= component('Nav/sideLinkCategory', ['title' => 'Category Title', 'icon' => 'fas fa-home']) ?>
           <?= component('Nav/sideLinkCategory', ['title' => 'Category Title', 'icon' => 'fas fa-home']) ?>
           <?= component('Nav/sideLinkCategory', ['title' => 'Category Title', 'icon' => 'fas fa-home']) ?>
           <?= component('Nav/sideLinkCategory', ['title' => 'Category Title', 'icon' => 'fas fa-home']) ?>

        </div>
        <div class="flex justify-center items-center h-[64px]  p-2">
            v1.0.0
        </div>
   
   </div>
   
   <div  class="subSideBar absolute hidden top-0  h-full flex-grow w-[270px] right-[-270px]  animate__animated animate__slideInLeft animate__faster bg-base-200">
    <div class=" flex items-center h-[64px] p-2">
        <p class="text-lg  font-bold">Category Title</p>
    </div>
    <ul class="menu h-full overflow-auto w-full">
        <li class="w-full"><a>Feature 1</a></li>
        <li class="bordered border-primary w-full"><a>Feature 2</a></li>

    </ul>
      
   </div>

</div>