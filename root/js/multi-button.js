
//multi action button
{
    //enable all menu buttons
    document.querySelectorAll('.mab').forEach(multiAction => {
        const menuButton = multiAction.querySelector('.mab__button--menu');
        const list = multiAction.querySelector('.mab__list');

        menuButton.addEventListener('click', () => {
            list.classList.toggle('mab__list--visible');
            console.log('toggle');
        });//closes toggle mab list visible
    });//closes querySelectorAll(''.mab')
    //hide all lists when clicking elsewhere on the screen
    document.addEventListener('click', e => {
        const keepOpen = (
            e.target.matches('.mab__list')
            || e.target.matches('.mab__button--menu')
            || e.target.closest('.mab__button--menu')
        );

        if (keepOpen) return;

        document.querySelectorAll('.mab__list').forEach(list => {
            list.classList.remove('mab__list--visible');
        });//closes remove mab list visible
    }); //closes document event listener click
}//closes multi action button