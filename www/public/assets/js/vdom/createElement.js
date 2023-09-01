export default ({type, attributes = {}, children = [], events = {}} = {}) => {
    if (!attributes) {
        attributes = {};
    }
    if (!children) {
        children = {};
    }
    if (!events) {
        events = {};
    }
    return {
        type,
        attributes,
        children,
        events
    };
};