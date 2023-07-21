import env from "/assets/js/env.js";

let erreur = ""
export default async function () {
    let builtUrl = new URL("/api/install/state", env.apiUrl);
    let res = await fetch(builtUrl);
    let data = await res.json();
    console.log(data)
    if (data.success) {
        if (!data.data?.dbState) {
            window.location.href = "/install/step1";
        }
        if (!data.data?.settingsState) {
            window.location.href = "/install/step2";
        }
        if (data.data?.smtpState) {
            window.location.href = "/install/step4";
        }
    }
    let handleSubmit = async (e) => {
        e.preventDefault();
        let formData = new FormData(e.target);
        let smtpData = {};
        formData.forEach((value, key) => smtpData[key] = value);
        let builtUrl = new URL("/api/install/smtp", env.apiUrl);
        let res = await fetch(builtUrl, {
            method: "POST",
            body: JSON.stringify(smtpData),
        });
        let data = await res.json();
        if (data.success) {
            window.location.href = "/install/step4";
        } else {
            erreur = data.errors.global;
            window.dispatchEvent(new Event('popstate'));
        }
    };
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
                                    "Informations SMTP"
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
                                                    for: "smtpPort"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "SMTP_PORT"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "smtpPort",
                                                    type: "text",
                                                    name: "smtpPort",
                                                    class: "input input-bordered w-full"
                                                }
                                            }
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
                                                    for: "smtpUser"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "SMTP_USER"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "smtpUser",
                                                    type: "text",
                                                    name: "smtpUser",
                                                    class: "input input-bordered w-full"
                                                }
                                            }
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
                                                    for: "smtpPassword"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "SMTP_PASSWORD"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "smtpPassword",
                                                    type: "password",
                                                    name: "smtpPassword",
                                                    class: "input input-bordered w-full"
                                                }
                                            }
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
                                                    for: "smtpSecureProtocol"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "Smtp protocol"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: 'select',
                                                attributes: {
                                                    id: 'smtpSecureProtocol',
                                                    name: 'smtpSecureProtocol',
                                                    class: 'select select-bordered w-full'
                                                },
                                                children: [
                                                    {type: 'option', attributes: {value: 'none'}, children: ['None']},
                                                    {type: 'option', attributes: {value: 'ssl'}, children: ['SSL']},
                                                    {type: 'option', attributes: {value: 'tls'}, children: ['TLS']}
                                                ]
                                            }
                                        ]
                                    }, {
                                        type: "div",
                                        attributes: {
                                            class: "col-span-full"
                                        },
                                        children: [
                                            {
                                                type: "label",
                                                attributes: {
                                                    class: "label",
                                                    for: "smtpHost"
                                                },
                                                children: [
                                                    {
                                                        type: "span",
                                                        attributes: {
                                                            class: "label-text"
                                                        },
                                                        children: [
                                                            "SMTP_HOST"
                                                        ]
                                                    }
                                                ]
                                            },
                                            {
                                                type: "input",
                                                attributes: {
                                                    id: "smtpHost",
                                                    type: "text",
                                                    name: "smtpHost",
                                                    class: "input input-bordered w-full",
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