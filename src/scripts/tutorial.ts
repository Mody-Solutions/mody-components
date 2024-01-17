import type {WP_Post} from 'wp-types'

type VideoTutorial = WP_Post & { video_url: string }

const sidebar = document.getElementById('mody_sidebar');
// @ts-ignore
mody_tutorials.forEach((tutorial: VideoTutorial) => {
  const link = document.createElement('a');
  link.href = `#${tutorial.ID}`;
  link.textContent = tutorial.post_title;
  link.setAttribute('data-postid', String(tutorial.ID));
  link.classList.add('sidebar-item', 'tutorial-sidebar-item');
  sidebar?.appendChild(link);
})

const triggers = document.querySelectorAll('.sidebar-item');
if (triggers) {
  triggers.forEach((item) => {
    item.addEventListener('click', (event) => {
      console.log(item)
      event.preventDefault();
      triggers.forEach(element => {
        element.classList.remove('active');
      });
      item.classList.add('active');
      const tutorialID: number = Number(item.getAttribute('data-postid'));
      // @ts-ignore
      const tutorial: VideoTutorial = mody_tutorials.find(tutorial => tutorial.ID === tutorialID);
      if (tutorial) {
        const main = document.getElementById('mody_main_content');

        if(main) {
          main.innerHTML = '';
          const title = document.createElement('h1');
          title.textContent = tutorial.post_title;
          title.classList.add('title', 'tutorial-title');

          const separator = document.createElement('hr');

          const video = document.createElement('video');
          video.src = tutorial?.video_url;
          video.controls = true;
          video.autoplay = true;
          video.width = 640;
          video.height = 480;

          const content = document.createElement('div');
          content.innerHTML = tutorial.post_content;

          const section = document.createElement('section');
          section.classList.add('main', 'tutorial-main');
          section.appendChild(video);
          section.appendChild(separator);
          section.appendChild(content);

          main?.appendChild(title);
          main?.appendChild(separator);
          main?.appendChild(section);
        }
      }
    })
  })
}
