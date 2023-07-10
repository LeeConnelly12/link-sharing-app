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

export function getIconForPlatform(platform) {
  const icons = {
    'Github': '/images/icon-github.svg',
    'Frontend Mentor': '/images/icon-frontend-mentor.svg',
    'Twitter': '/images/icon-twitter.svg',
    'LinkedIn': '/images/icon-linkedin.svg',
    'Youtube': '/images/icon-youtube.svg',
    'Facebook': '/images/icon-facebook.svg',
    'Twitch': '/images/icon-twitch.svg',
    'Dev.to': '/images/icon-devto.svg',
    'Codewars': '/images/icon-codewars.svg',
    'freeCodeCamp': '/images/icon-freecodecamp.svg',
    'GitLab': '/images/icon-gitlab.svg',
    'Hashnode': '/images/icon-hashnode.svg',
    'Stack Overflow': '/images/icon-stack-overflow.svg',
  }

  return icons[platform]
}

export function getGrayIconForPlatform(platform) {
  const icons = {
    'Github': '/images/icon-github-gray.svg',
    'Frontend Mentor': '/images/icon-frontend-mentor-gray.svg',
    'Twitter': '/images/icon-twitter-gray.svg',
    'LinkedIn': '/images/icon-linkedin-gray.svg',
    'Youtube': '/images/icon-youtube-gray.svg',
    'Facebook': '/images/icon-facebook-gray.svg',
    'Twitch': '/images/icon-twitch-gray.svg',
    'Dev.to': '/images/icon-devto-gray.svg',
    'Codewars': '/images/icon-codewars-gray.svg',
    'freeCodeCamp': '/images/icon-freecodecamp-gray.svg',
    'GitLab': '/images/icon-gitlab-gray.svg',
    'Hashnode': '/images/icon-hashnode-gray.svg',
    'Stack Overflow': '/images/icon-stack-overflow-gray.svg',
  }

  return icons[platform]
}
