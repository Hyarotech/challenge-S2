const renderElem = ({type, attributes, children, events}) => {
    const $el = document.createElement(type);
    if (!attributes) attributes = {};
    if (!children) children = [];
    if (!events) events = {};
    // set attributes
    for (const [k, v] of Object.entries(attributes)) {
        $el.setAttribute(k, v);
    }
    // set children
    for (let i = 0; i < children?.length ?? 0; i++) {
        $el.appendChild(render(children[i]));
    }
    for (const [k, v] of Object.entries(events)) {
        $el.addEventListener(k, v);
    }
    return $el;
};

const render = (vNode) => {
    if (typeof vNode === 'string') {
        return document.createTextNode(vNode);
    }

    return renderElem(vNode);
}


export default render;