if [ $# -gt 0 ];then
    case "$1" in
        "composer")
            docker run --rm -it -v $(pwd):/app -w /app composer $@
            ;;
    esac
else
    usage
fi
