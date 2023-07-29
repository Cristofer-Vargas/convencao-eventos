document.addEventListener("DOMContentLoaded", createTableOfContents);

function createTableOfContents() {
  const headers = document.querySelectorAll("h1, h2, h3, h4, h5, h6");
	const sumarioDocument = document.getElementById("sumario-document");

  for (let i = 0; i < headers.length; i++ ) {
    const header = headers[i]
    const headerLevel = parseInt(header.nodeName.toLowerCase().replace('h', ''))
    const headerContent = header.innerText.toLowerCase().replaceAll(' ', '-')

    const div = document.createElement('div')
    const a = document.createElement('a')
    div.classList.add(`level-${headerLevel}`)
    div.classList.add(`sumary-nvs`)
    a.setAttribute('href', `#${headerContent}`)
    a.innerText = header.innerText
    a.addEventListener('click', scrollToHeader)
    header.setAttribute('id', `${headerContent}`)

    div.append(a)
    sumarioDocument.append(div)
  }
}

function scrollToHeader() {
  const targetHeaderId = this.getAttribute('href').replace('#', '');
  const targetHeader = document.getElementById(targetHeaderId);
  targetHeader.scrollIntoView({ behavior: 'smooth', block: 'center' });
}