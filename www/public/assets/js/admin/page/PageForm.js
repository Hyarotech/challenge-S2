 
class PageForm {
    constructor() {

    }

    slugInputEvent = () => {
        const title = $('input[name="title"]');
        const slugInput = $('input[name="slug"]');     
        const slugHandler = () => {
            const slug = this.generateSlug(title.val());
            $(slugInput).val(slug);
        }
        title.off('input',slugHandler);
        title.on('input',slugHandler);
    }

    generateSlug = (title) => {
        return title.replace(/[^a-zA-Z0-9]+/g, '-').replace(/-+/g, '-').toLowerCase();
    }

}

export default new PageForm();