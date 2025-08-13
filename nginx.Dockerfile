FROM nginx:1.24-alpine

RUN apk update && apk upgrade

RUN apk add curl

CMD ["nginx", "-g", "daemon off;"]
