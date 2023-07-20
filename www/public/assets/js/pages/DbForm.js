import env from "/assets/js/env.js";

export default async () => {
    let builtUrl = new URL("/api/install/state", env.apiUrl);
    let res = await fetch(builtUrl);
    let data = await res.json();
    if (data.dbState) {
        window.location.href = "/install/step2";
    }
    function handleSubmit(e){
        e.preventDefault();
        console.log(e.target)
        let formData = new FormData(e.target);
        console.log(formData);
    }
    return {
        "type": "div",
        "attributes": {
            "class": "w-full h-full flex justify-center items-center bg-blue animate__animated animate__fadeIn "
        },
        "children": [
            {
                "type": "div",
                "attributes": {
                    "class": "card h-auto bg-base-200 shadow-xl"
                },
                "children": [
                    {
                        "type": "form",
                        "attributes": {
                            "onsubmit": "",
                            "method": "post",
                            "class": "card-body"
                        },
                        "events":{
                            submit:handleSubmit
                        },
                        "children": [
                            {
                                "type": "h1",
                                "attributes": {
                                    "class": "text-3xl"
                                },
                                "children": [
                                    "Installation de la base de données"
                                ]
                            },
                            {
                                "type": "hr"
                            },
                            {
                                "type": "p",
                                "attributes": {
                                    "class": "text-sm mt-2 text-red-500 text-center"
                                }
                            },
                            {
                                "type": "div",
                                "attributes": {
                                    "class": "grid grid-cols-12 gap-4"
                                },
                                "children": [
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": " col-span-6"
                                        },
                                        "children": [
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label",
                                                    "for": "bddName"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Nom de la base de données"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "bddName",
                                                    "type": "text",
                                                    "name": "bddName",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text-alt text-red-500"
                                                        },
                                                        "children": [
                                                            "\r\n                            erreur ici\r\n                        "
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": " col-span-6"
                                        },
                                        "children": [
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label",
                                                    "for": "bddHost"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Host de la base de données"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "bddHost",
                                                    "type": "text",
                                                    "name": "bddHost",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text-alt text-red-500"
                                                        },
                                                        "children": [
                                                            "\r\n                            erreur ici\r\n                        "
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": " col-span-6"
                                        },
                                        "children": [
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label",
                                                    "for": "bddPort"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Port de la base de données"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "bddPort",
                                                    "type": "text",
                                                    "name": "bddPort",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text-alt text-red-500"
                                                        },
                                                        "children": [
                                                            "\r\n                            erreur ici\r\n                        "
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": " col-span-6"
                                        },
                                        "children": [
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label",
                                                    "for": "bddUser"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "User admin de la base de données"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "bddUser",
                                                    "type": "text",
                                                    "name": "bddUser",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text-alt text-red-500"
                                                        },
                                                        "children": [
                                                            "\r\n                            erreur ici\r\n                        "
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": " col-span-full"
                                        },
                                        "children": [
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label",
                                                    "for": "bddPwd"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Password de la base de données"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "bddPwd",
                                                    "type": "text",
                                                    "name": "bddPwd",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                            {
                                                "type": "label",
                                                "attributes": {
                                                    "class": "label"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text-alt text-red-500"
                                                        },
                                                        "children": [
                                                            "\r\n                            erreur ici\r\n                        "
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                "type": "div",
                                "attributes": {
                                    "class": "flex w-full flex-wrap"
                                },
                                "children": [
                                    {
                                        "type": "div",
                                        "attributes": {
                                            "class": "flex w-full justify-center mt-6"
                                        },
                                        "children": [
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "type": "submit",
                                                    "value": "Ajouter",
                                                    "class": "btn btn-primary"
                                                }
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    }
}