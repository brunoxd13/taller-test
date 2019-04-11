import React from 'react'
import { Mutation } from 'react-apollo'
import gql from 'graphql-tag'
import Router from 'next/router'

export const logoutMutation = gql`
  mutation UserLogout {
    user: userLogout {
      uid
      name
    }
  }
`
const LogoutContainer = ({ children }) => (
  <Mutation mutation={ logoutMutation }>
    {(logoutMutate, error, loading) => {
      const logoutUser = () => {
        logoutMutate()
        Router.push('/')
      }

      return children({ logoutUser, error, loading })
    }}
  </Mutation>
)

export default LogoutContainer
