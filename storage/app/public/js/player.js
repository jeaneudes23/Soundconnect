const audio = new Audio()
let player

document.addEventListener('click' , (e)=>{
  const target = e.target
  if (!target) return
  const source = target.closest('[data-play-source]')
  if (source) handlePlay(source)
  target.closest('[data-progress-container]') && handleProgress(e,target.closest('[data-progress-container]') )
})

const handlePlay = (source)=>{
  const audioSource = source.getAttribute('data-play-source')
  player = source.closest('[data-player]')
  if (!player) return
  if (audio.src === audioSource){
    const status = player.getAttribute('data-play-status') == "true"
    status ? audio.pause() : audio.play();
    player.setAttribute('data-play-status', `${!status}`);
  }else{
    audio.src = audioSource
    document.querySelectorAll('[data-player=true]').forEach(item => {
      item.setAttribute('data-play-status','false')
      item.setAttribute('data-player', 'false')
      item.querySelector('[data-progress-bar]').style.width = `0%`
      item.querySelector('[data-progress-container]').setAttribute('disabled','true')
    })
    player.setAttribute('data-player', 'true')
    player.setAttribute('data-play-status', 'true')
    player.querySelector('[data-progress-container]').removeAttribute('disabled')
    audio.play()
  }
}

const handleProgress = (e,progressBar) => {
  audio.currentTime = audio.duration * e.offsetX / progressBar.clientWidth
}


audio.addEventListener('timeupdate', ()=>{
  if (!player) return 
  const progress = player.querySelector('[data-progress-bar]') 
  progress.style.width = `${audio.currentTime * 100 / audio.duration}%`

})


