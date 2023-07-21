import env from "/assets/js/env.js";

let erreur = ""
export default async () => {
    let builtUrl = new URL("/api/install/state", env.apiUrl);
    let res = await fetch(builtUrl);
    let data = await res.json();
    if (data.success) {
        if (!data.data?.dbState) {
            window.location.href = "/install/step1";
        }
        if (data.data?.settingsState) {
            window.location.href = "/install/step3";
        }
    }
    const handleSubmit = async (e) => {
        e.preventDefault();
        let formData = new FormData(e.target);
        let builtUrl = new URL("/api/install/settings", env.apiUrl);
        let settingsData = {
            appUrl: formData.get("appUrl"),
            appName: formData.get("appName"),
            appFromEmail: formData.get("appFromEmail")
        }
        let res = await fetch(builtUrl, {
            method: "POST",
            body: JSON.stringify(settingsData),
        });
        let data = await res.json();
        if (data.success) {
            window.location.href = "/install/step3";
        } else {
            erreur = data.errors.global;
            window.dispatchEvent(new Event('popstate'));
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
                                    "Informations du site"
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
                                "children": [
                                    {
                                        type: "div",
                                        attributes: {
                                            class: "col-span-6"
                                        },
                                        children: [
                                            {
                                                type: "label",
                                                attributes: {
                                                    class: "label",
                                                    for: "appUrl"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "Your app url"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "appUrl",
                                                    type: "text",
                                                    name: "appUrl",
                                                    class: "input input-bordered w-full",
                                                }
                                            },
                                        ]
                                    },
                                    {
                                        type: "div",
                                        attributes: {
                                            class: "col-span-6"
                                        },
                                        children: [
                                            {
                                                type: "label",
                                                attributes: {
                                                    class: "label",
                                                    for: "appName"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "Your app name"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "appName",
                                                    type: "text",
                                                    name: "appName",
                                                    class: "input input-bordered w-full"
                                                }
                                            }
                                        ]
                                    },
                                    {
                                        type: "div",
                                        attributes: {
                                            class: "col-span-full"
                                        },
                                        children: [
                                            {
                                                type: "label",
                                                attributes: {
                                                    class: "label",
                                                    for: "appFromEmail"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "Your app from email"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "appFromEmail",
                                                    type: "email",
                                                    name: "appFromEmail",
                                                    class: "input input-bordered w-full"
                                                }
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