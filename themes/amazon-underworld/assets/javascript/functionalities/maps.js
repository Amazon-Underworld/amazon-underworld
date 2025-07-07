import { until } from '../shared/wait'

function mapHasBoxes () {
    const maps = Array.from(document.querySelectorAll('.jeomap'))
    return maps.every((map) => {
        return map.querySelector('.layers-selection') && map.querySelector('.legend-container')
    })
}

document.addEventListener('DOMContentLoaded', async () => {
    await until(mapHasBoxes)

    document.querySelectorAll('.jeomap .layers-selection').forEach((layersContainer) => {
        layersContainer.classList.add('hidden')
        layersContainer.querySelector('.arrow-icon').classList.remove('active')
        layersContainer.querySelector('.layers-wrapper').style.display = 'none'
    })

    document.querySelectorAll('.jeomap .legend-container').forEach((legendContainer) => {
        legendContainer.classList.add('hidden')
        legendContainer.querySelector('.arrow-icon').classList.remove('active')
        legendContainer.querySelector('.hideable-content').style.display = 'none'
    })
})
