export function getColorForPlatform(platform) {
  const colors = {
    'Github': '#1A1A1A',
    'Frontend Mentor': '#FFF',
    'Twitter': '#43B7E9',
    'LinkedIn': '#2D68FF',
    'Youtube': '#EE3939',
    'Facebook': '#2442AC',
    'Twitch': '#9146ff',
    'Dev.to': '#333',
    'Codewars': '#8A1A50',
    'freeCodeCamp': '#302267',
    'GitLab': '#EB4925',
    'Hashnode': '#0330D1',
    'Stack Overflow': '#EC7100',
  }

  return colors[platform] ?? '#FAFAFA'
}
