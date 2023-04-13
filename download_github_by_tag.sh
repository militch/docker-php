#!/bin/sh

download_github_by_tag(){
    archive_url="${1}/archive/refs"
    filename="${2}.tar.gz"
    download_url="${GITHUB_HOST}/${archive_url}/tags/${filename}"
    echo "Fetch ${1}:${2} from ${GITHUB_HOST} to $3"
    curl -sL -o- "${download_url}" | tar -xz --strip-components 1 -C $3
}

download_github_by_tag "$@"
