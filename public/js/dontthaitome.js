// Config
const position = document.currentScript.getAttribute('data-position') || 'top';
const isTop = position === 'top';
const message = "Don't Thai To Me"
const angkor = 'https://cambodianeedpeace.org/images/angkor.svg';

// Element
const div = document.createElement('div');
const style = document.createElement('style');

style.textContent = /*css*/ `
body {
  ${isTop ? 'margin-top: 63px;' : 'margin-bottom: 63px;'}
}
.support_cambodia,
.support_cambodia:visited {
  ${isTop ? 'top: 0;' : 'bottom: 0;'}
  position: fixed;
  padding: 0;
  margin: 0;
  left: 0;
  right: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 10000;
  text-decoration: none;
  font-family: arial;
}
.support_cambodia__red {
  background: #C21111;
  height: 21px;
  width: 100%;
}
.support_cambodia__blue {
  background: #152C8A;
  height: 21px;
  width: 100%;
}
.support_cambodia__wrapper {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 20px;
  position: absolute;
  bottom:0;
  top: 0;
  color: white;
  font-weight: 600;
}
`;

div.innerHTML = /*html*/ `
<a
  class="support_cambodia"
  href="https://x.com/hashtag/CambodiaNeedPeace"
  target="_blank"
  rel="nofollow noopener"
  title="Don't Thai To Me"
>
  <div class='support_cambodia__blue'></div>
  <div class='support_cambodia__red'></div>
  <div class='support_cambodia__blue'></div>

    <div class='support_cambodia__wrapper'>
      <p>Don't Thai To Me</p>
      <span>
        <svg width="64" height="64">
            <image xlink:href="${angkor}" src="${angkor}" width="64" height="64"/>
        </svg>
      </span>
      <p>អាចោរសៀម</p>
    </div>
  </div>
</a>
`;

document.head.appendChild(style);
if (isTop) {
  document.body.prepend(div);
} else {
  document.body.appendChild(div);
}
