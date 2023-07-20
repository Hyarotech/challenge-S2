import env from "/assets/js/env.js";

let erreur = "";
export default async () => {
    let builtUrl = new URL("/api/install/state", env.apiUrl);
    let res = await fetch(builtUrl);
    let data = await res.json();
    if (data.success) {
        if (!data.data?.dbState) {
            window.location.href = "/install/step1";
        }
        if (!data.data?.settingsState) {
            window.location.href = "/install/step2";
        }
        if (!data.data?.smtpState) {
            window.location.href = "/install/step3";
        }
    }
    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const adminData = {};
        formData.forEach((value, key) => adminData[key] = value);
        let urlBuilt = new URL("/api/install/admin", env.apiUrl);
        let response = await fetch(urlBuilt, {
            method: "POST",
            body: JSON.stringify(adminData),
        });
        let data = await response.json();
        if (data.success) {
            let urlBuilt = new URL("/api/install", env.apiUrl);
            let response = await fetch(urlBuilt, {
                method: "POST",
                body: JSON.stringify({admin: true}),
            });
            let data = await response.json();
            if (data.success) {
                window.location.href = "/";
            }
        }

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
                            "method": "post",
                            "class": "card-body"
                        },
                        "events": {
                            submit: handleSubmit
                        },
                        "children": [
                            {
                                "type": "h1",
                                "attributes": {
                                    "class": "text-3xl text-center"
                                },
                                "children": [
                                    "Créez votre compte administrateur"
                                ]
                            },
                            {
                                "type": "hr"
                            },
                            {
                                "type": "p",
                                "attributes": {
                                    "class": "text-sm mt-2 text-red-500 text-center"
                                },
                                "children": [
                                    erreur ? erreur : ""
                                ]
                            },
                            {
                                "type": "div",
                                "attributes": {
                                    "class": "grid grid-cols-12 gap-4"
                                },
                                children: [
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
                                                    "for": "email"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Email"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "email",
                                                    "type": "email",
                                                    "name": "email",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
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
                                                    "for": "password"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Mot de passe"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "password",
                                                    "type": "password",
                                                    "name": "password",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
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
                                                    "for": "passwordConfirm"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Confirme le mot de passe"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "passwordConfirm",
                                                    "type": "password",
                                                    "name": "passwordConfirm",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
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
                                                    "for": "firstname"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Prénom"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "firstname",
                                                    "type": "text",
                                                    "name": "firstname",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
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
                                                    "for": "lastname"
                                                },
                                                "children": [
                                                    {
                                                        "type": "span",
                                                        "attributes": {
                                                            "class": "label-text"
                                                        },
                                                        "children": [
                                                            "Nom"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                "type": "input",
                                                "attributes": {
                                                    "id": "lastname",
                                                    "type": "text",
                                                    "name": "lastname",
                                                    "class": "input input-bordered w-full",
                                                }
                                            },
                                        ]
                                    },

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
                                                    "value": "Suivant",
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