#!/bin/bash

mkdir testdir

cd ./testdir || exit 1

create_dirs () {
for i in {1..22}; do
    mkdir root$i
    for j in 1 2 3; do
        mkdir ./root$i/child$j
        touch ./root$i/child$j/file
    done
done
}

create_files () {
mkdir ./filesall
for i in {1..22}; do
    for j in 1 2 3; do
        cp ./root$i/child$j/file ./filesall/file${i}_${j}
    done
done
}

case $1 in
    str) create_dirs
    ;;
    file) create_files
    ;;
    *) echo "Usage: `basename $0` str | file"
    ;;
esac
