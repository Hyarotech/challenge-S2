 
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
        return title.replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-');
    }

}

export default new PageForm();