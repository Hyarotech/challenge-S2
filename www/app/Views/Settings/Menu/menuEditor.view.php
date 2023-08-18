<div class="p-5">
    <h1 class="text-4xl text-center font-bold mb-5">Editeur de menu</h1>
    
        
        
        <div class="card md:w-3/6 m-auto flex justify-center bg-base-200 p-5 gap-4" id="flex-form">
            <form class="card bg-base-300 max-h-[230px] gap-2 p-5 flex self-start" id="addForm">
                <input type="text" placeholder="Titre" class="input w-full max-w-xs" />
                <div class="flex flex-row">
                    <div class="form-control">
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text">Page</span> 
                                <input type="radio" value="0" name="radio-10" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                        <div class="form-control">
                            <label class="label cursor-pointer gap-2 ">
                                <span class="label-text">Lien</span> 
                                <input type="radio" value="1" name="radio-10" class="radio checked:bg-primary" checked />
                            </label>
                        </div>
                </div>
                <input type="text" placeholder="Lien" class="input input-sm w-full max-w-xs" />

                <button type="button" class="btn flex self-end mt-3 btn-sm btn-primary">Ajouter</button>
            </form>

            <div id="menuList" class="">
                <div class="flex flex-col" aria-label="parent-menu-item-dropdown">
                    <div class="card flex flex-row p-3 justify-between bg-base-300">
                        <p>Home</p>
                        <div class="flex gap-2">
                            <button title="Supprimer le lien" class="btn btn-xs btn-error btn-circle btn-outline">
                            <i class="fa-solid fa-trash"></i>
                            </button>
                            <button title="Modifier le lien" class="btn btn-xs btn-info btn-circle btn-outline">
                                    <i class="fa-solid fa-pen"></i>
                            </button>
                            <button title="Ajouter un lien" class="btn btn-xs btn-success btn-circle btn-outline">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <button title="Descendre le lien" class="btn btn-xs btn-circle btn-outline">
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <button title="Monter le lien" class="btn btn-xs btn-circle btn-outline">
                            <i class="fa-solid fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="my-2 flex flex-col pl-4" aria-label="menu-item-child">
                            <div class="card flex flex-row p-3 justify-between bg-base-100">
                                <p>Home</p>
                                <div class="flex gap-2">
                                    <button title="Supprimer le lien" class="btn btn-xs btn-error btn-circle btn-outline">
                                    <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button title="Modifier le lien" class="btn btn-xs btn-info btn-circle btn-outline">
                                            <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button title="Ajouter un lien" class="btn btn-xs btn-success btn-circle btn-outline">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <button title="Descendre le lien" class="btn btn-xs btn-circle btn-outline">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                    <button title="Monter le lien" class="btn btn-xs btn-circle btn-outline">
                                    <i class="fa-solid fa-chevron-up"></i>
                                    </button>
                                </div>
                            </div>
                            
                        </div>     
                          
                    
                </div>

                
            </div>

        </div>
        <div>
        </div>

    
  

</div>
